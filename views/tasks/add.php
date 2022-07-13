<?php

/* @var object $addTaskForm */

/* @var array $coordinates */


use yii\helpers\Url;
use yii\widgets\ActiveForm;


?>
<script type="text/javascript"
        src="https://api-maps.yandex.ru/2.1/?apikey=e666f398-c983-4bde-8f14-e3fec900592a&lang=ru_RU">

</script>
<script type="text/javascript">

    function init() {
        var myPlacemark,
            myMap = new ymaps.Map('map', {
                    center: [<?=$coordinates['lat']?>, <?=$coordinates['lon']?>],
                    zoom: 15,
                    controls: [],
                },
            );


        // Слушаем клик на карте.
        myMap.events.add('click', function (e) {
            var coords = e.get('coords');

            // Если метка уже создана – просто передвигаем ее.
            if (myPlacemark) {
                myPlacemark.geometry.setCoordinates(coords);
                document.getElementById('taskCoordinate').value = coords;
            }
            // Если нет – создаем.
            else {
                myPlacemark = createPlacemark(coords);
                myMap.geoObjects.add(myPlacemark);
                // Слушаем событие окончания перетаскивания на метке.
                myPlacemark.events.add('dragend', function () {
                    getAddress(myPlacemark.geometry.getCoordinates());
                });
                document.getElementById('taskCoordinate').value = coords;
            }
            getAddress(coords);
        });

        // Создание метки.
        function createPlacemark(coords) {
            return new ymaps.Placemark(coords, {
                iconCaption: 'поиск...'
            }, {
                preset: 'islands#violetDotIconWithCaption',
                draggable: true
            });
        }

        // Определяем адрес по координатам (обратное геокодирование).
        function getAddress(coords) {
            myPlacemark.properties.set('iconCaption', 'поиск...');
            ymaps.geocode(coords).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0);

                myPlacemark.properties
                    .set({
                        // Формируем строку с данными об объекте.
                        iconCaption: [
                            // Название населенного пункта или вышестоящее административно-территориальное образование.
                            firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                            // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                            firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                        ].filter(Boolean).join(', '),
                        // В качестве контента балуна задаем строку с адресом объекта.
                        balloonContent: firstGeoObject.getAddressLine()
                    });
                document.getElementById('autoComplete').value = firstGeoObject.getAddressLine();

            });
        }


        let findBtn = document.getElementById('btn-address')
        findBtn.onclick = function () {
            async function getCoordinate() {

                // запрашиваем информацию об этом пользователе из github
                const geoResponse = await fetch(`https://geocode-maps.yandex.ru/1.x/?apikey=e666f398-c983-4bde-8f14-e3fec900592a&format=json&geocode=${document.getElementById('autoComplete').value}`);
                const geoData = await geoResponse.json();

                const geopoints = geoData.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos

                const temp = geopoints.split(" ");

                const length = Number(temp[1]);
                const width = Number(temp[0]);

                const coordinates = [length, width]
                document.getElementById('taskCoordinate').value = coordinates;

                if (myPlacemark) {
                    myPlacemark.geometry.setCoordinates(coordinates);
                }
                // Если нет – создаем.
                else {
                    myPlacemark = createPlacemark(coordinates);
                    myMap.geoObjects.add(myPlacemark);
                    // Слушаем событие окончания перетаскивания на метке.
                    myPlacemark.events.add('dragend', function () {
                        getAddress(myPlacemark.geometry.getCoordinates());
                    });

                }
                getAddress(coordinates);



                return myMap.panTo(coordinates,
                    {
                        flying: true

                    });

            }
            getCoordinate()


        }


    }

    ymaps.ready(init);

</script>

<main class="main-content main-content--center container">
    <div class="add-task-form regular-form">

        <?php
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($addTaskForm, 'name',['enableAjaxValidation'=>true])->textInput()
        ?>
        <?= $form->field($addTaskForm, 'info')->textarea()
        ?>
        <?= $form->field($addTaskForm, 'category_id')->dropDownList(\app\models\forms\AddTaskForm::getCategory())
        ?>
        <?= $form->field($addTaskForm, 'city_id')->dropDownList(\app\models\forms\AddTaskForm::getCities())
        ?>
        <div class="half-wrapper">
            <?= $form->field($addTaskForm, 'price')->textInput()
            ?>
            <?= $form->field($addTaskForm, 'deadline_time', ['enableAjaxValidation' => true])->textInput(
                ['type' => 'date']
            )
            ?>
        </div>
        <div class="task-map">
            <div id="map" style="width: 600px; height: 400px"></div

        </div>


        <div class="autoComplete_wrapper">
            <?= $form->field(
                $addTaskForm,
                'address')
                ->textInput([
                    'id'             => 'autoComplete',
                    'style'          => 'width: 700px',
                    'type'           => 'search',
                    'dir'            => 'ltr',
                    'spellcheck'     => false,
                    'autocorrect'    => 'off',
                    'autocapitalize' => 'off',

                ])->label(false)
            ?>
            <?= $form->field(
                $addTaskForm,
                'tasks_coordinate')
                ->textInput([
                    'id'             => 'taskCoordinate',
                    'style'          => 'display:none',
                    'type'           => 'search',
                    'dir'            => 'ltr',
                    'spellcheck'     => false,
                    'autocorrect'    => 'off',
                    'autocapitalize' => 'off',

                ])->label(false)
            ?>

        </div>


        <?= $form->field($addTaskForm, 'files[]')->fileInput(['multiple' => true]) ?>
        <?= \yii\helpers\Html::submitButton('опубликовать', ['class' => 'button button--blue']) ?>
        <?php
        ActiveForm::end(); ?>

    </div>


</main>
<script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>
<script>

    const autoCompleteJS = new autoComplete({
        placeHolder: "Введите Адрес",
        data: {

            src: async (query) => {
                try {
                    // Fetch Data from external Source
                    const source = await fetch('<?=Url::toRoute('api/index')?>',
                        {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json;charset=utf-8',
                                'X-CSRF-TOKEN': '<?=Yii::$app->request->getCsrfToken()?>',
                            },
                            body: JSON.stringify(document.getElementById('autoComplete').value)

                        }
                    )
                    // Data should be an array of `Objects` or `Strings`
                    const data = await source.json();
                    console.log(data)
                    console.log(JSON.stringify(document.getElementById('autoComplete').value))

                    return data;
                } catch (error) {
                    return error;
                }
            },
            // Data source 'Object' key to be searched
            keys: [""]
        },
        resultItem: {
            highlight: true
        },
        resultsList: {
            maxResults: 5
        },
        events: {
            input: {
                selection: (event) => {
                    const selection = event.detail.selection.value;
                    autoCompleteJS.input.value = selection;
                }
            }
        }
    });

</script>

