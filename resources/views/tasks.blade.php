<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Список задач</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="//pagination.js.org/dist/2.1.2/pagination.css">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <link rel="stylesheet" type="text/css" href="/css/app.css">

        <script
          src="https://code.jquery.com/jquery-3.3.1.min.js"
          integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
          crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script type="text/javascript" src="//pagination.js.org/dist/2.1.2/pagination.min.js"></script>

        <script type="text/javascript" src="/js/app.js"></script>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div id="tasks-list" class="tasks-list">
                    <input
                        class="tasks-list__search"
                        type="text"
                        placeholder="Поиск"
                    >
                    <div class="tasks-list__table-wrapper">
                        <table class="tasks-list__table">
                            <thead>
                                <tr>
                                    <th>Номер задачи</th>
                                    <th>Заголовок</th>
                                    <th>Дата выполнения</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
    
                    <div class="tasks-list__pagination"></div>

                    <div class="tasks-list__modal">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Заголовок</td>
                                    <td class="tasks-list__modal-title"></td>
                                </tr>
                                <tr>
                                    <td>Дата выполнения</td>
                                    <td class="tasks-list__modal-date"></td>
                                </tr>
                                <tr>
                                    <td>Автор</td>
                                    <td class="tasks-list__modal-author"></td>
                                </tr>
                                <tr>
                                    <td>Статус</td>
                                    <td class="tasks-list__modal-status"></td>
                                </tr>
                                <tr>
                                    <td>Описание</td>
                                    <td class="tasks-list__modal-desc"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            (function() {

                var tasksList = new TasksList('#tasks-list');

            })();
        </script>
    </body>
</html>
