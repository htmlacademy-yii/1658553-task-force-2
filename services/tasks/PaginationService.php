<?php

namespace app\services\tasks;

use yii\data\Pagination;

class PaginationService
{
    public int $pageSize;
    public bool $forcePageParam;
    public bool $pageSizeParam;
    public object $query;
    private object $pages;

    public function __construct($query, $pageSize,$forcePageParam,$pageSizeParam)
    {
        $this->pages = new Pagination(['totalCount'     => $query->count(),
                                            'pageSize'       => $pageSize,
                                            'forcePageParam' => $forcePageParam,
                                            'pageSizeParam'  => $pageSizeParam,]);

    }

    public function getTasksList(){
        return $this->query->offset($this->pages->offset)->limit($this->pages->limit)->all();

    }
    private function cleanUrl(){

        foreach ($this->pages->links as $page=>$url){
            $url = str_replace('?%2Ftasks%2Findex=&','',$url);
        }

    }



    public function getPageContent(){
         $this->cleanUrl();
         return $this->getTasksList();
    }

}