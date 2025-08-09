jQuery(document).ready(function($) {
    /*
     * Общие настройки ajax-запросов, отправка на сервер csrf-токена
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*
     * Подключение wysiwyg-редактора для редактирования контента страницы
     */
    $('textarea[id="editor"]').summernote({
        lang: 'ru-RU',
        height: 300,
        
    });
});