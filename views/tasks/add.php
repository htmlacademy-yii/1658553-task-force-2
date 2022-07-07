<?php

/* @var object $addTaskForm */

/* @var object $userInfo */

$coordinates = [];
$coordinates['lat'] = unpack('x/x/x/x/corder/Ltype/dlat/dlon', $userInfo->city->coordinates)['lat'];
$coordinates['lon'] = unpack(
    'x/x/x/x/corder/Ltype/dlat/dlon',
    $userInfo->city->coordinates
)['lon'];


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
                    zoom: 12,
                    controls: [],
                },
            );
        console.log(myMap)

        // Слушаем клик на карте.
        myMap.events.add('click', function (e) {
            var coords = e.get('coords');

            // Если метка уже создана – просто передвигаем ее.
            if (myPlacemark) {
                myPlacemark.geometry.setCoordinates(coords);
            }
            // Если нет – создаем.
            else {
                myPlacemark = createPlacemark(coords);
                myMap.geoObjects.add(myPlacemark);
                // Слушаем событие окончания перетаскивания на метке.
                myPlacemark.events.add('dragend', function () {
                    getAddress(myPlacemark.geometry.getCoordinates());
                });
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
                document.getElementById('address').value = firstGeoObject.getAddressLine();

            });
        }

        // Создадим экземпляр элемента управления «поиск по карте»
        // с установленной опцией провайдера данных для поиска по организациям.
        let searchControl = new ymaps.control.SearchControl({
            options: {
                provider: 'yandex#map',
            }
        });

        let findBtn = document.getElementById('btn-address')
        findBtn.onclick = function () {
            myMap.controls.add(searchControl);
            searchControl.search(document.getElementById('address').value);

        }

    }

    ymaps.ready(init);

</script>

<main class="main-content main-content--center container">
    <div class="add-task-form regular-form">

        <?php
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($addTaskForm, 'name', ['enableAjaxValidation' => true])->textInput()
        ?>
        <?= $form->field($addTaskForm, 'info', ['enableAjaxValidation' => true])->textarea()
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
                    <!--            <p class="map-address town">--><!--</p>-->
                    <!--            <p class="map-address">Новый арбат, 23, к. 1</p>-->

        </div>


        <form>
            <input class="address" id="address" style="width: 600px;" type="text" value=""
                   placeholder="тут появится адрес">


            <button type="button" class="btn-address" id="btn-address">Найти</button>
        </form>

        <?= $form->field($addTaskForm, 'files[]')->fileInput(['multiple' => true]) ?>
        <?= \yii\helpers\Html::submitButton('опубликовать', ['class' => 'button button--blue']); ?>
        <?php
        ActiveForm::end(); ?>

    </div>


</main>

