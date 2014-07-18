<?php namespace Antoniputra\Asmoyo\Utilities\Pagination;

use Illuminate\Pagination\Presenter;

class AjaxPresenter extends Presenter {

    public function getActivePageWrapper($text)
    {
        return '<li class="active"><span>'.$text.'</span></li>';
    }

    public function getDisabledTextWrapper($text)
    {
        return '<li class="disabled"><span>'.$text.'</span></li>';
    }

    public function getPageLinkWrapper($url, $page)
    {
        return "<li><a onClick='ajaxPaginationLink(\"$url\")' style='cursor:pointer;' >$page</a></li>";
    }

}