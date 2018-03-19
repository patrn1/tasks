(function(w) {

    /**
     * Creates a TasksList instance.
     *
     * @constructor
     * @this  {TasksList}
     * @param {string} selector - Element selector.
     */
    w.TasksList = function(selector) {

        var self = this;

        this.elem = $(selector);
        this.modal = self
            .elem
            .find(".tasks-list__modal")
            .dialog({
                autoOpen : false
            });
        this.tasks = null;
        this.tasksDetails = {};

        /**
         * Initializes the tasks list.
         *
         * @param {array} tasks - Tasks list.
         */
        var initList = function(tasks) {
            self.elem
                .find('.tasks-list__pagination')
                .pagination({
                    dataSource: function(done) {

                        if (tasks) return done(tasks);

                        $.ajax({
                            dataType: 'json',
                            url: '/api/v1/task',
                            success: function(tasks) {
                                self.tasks = tasks;
                                done(tasks);
                            }
                        });
                    },
                    callback: function(tasks) {
                        var html = '';
                        tasks.forEach(function(task) {
                            html +=
                                '<tr' +
                                    ' data-id="' + task.id + '"' +
                                    ' class="tasks-list__row"' +
                                '>' +
                                    '<td>' + task.id + '</td>' +
                                    '<td>' + task.title + '</td>' +
                                    '<td>' + task.date + '</td>' +
                                '<tr>';
                        }); 

                        self.elem
                            .find('.tasks-list__table tbody')
                            .html(html);
                    }
                });
        };

        /**
         * Initializes the event listeners.
         */
        var initEventListeners = function() {
            self.elem
                .find('.tasks-list__search')
                .on('keyup', function() {
                    self.searchByTitle(
                        $(this).val()
                    );
                });
            self.elem
                .click(function(evt) {
                    var taskId = $(evt.target)
                        .closest('.tasks-list__row')
                        .data('id');
                    if (taskId) {
                        self.showTaskDetails(taskId);
                    }
                });    
        };

        /**
         * Searchs tasks by the title.
         *
         * @param {string} query - Search query.
         */
        this.searchByTitle = function(query) {
            var matches = self.tasks.reduce(function(result, task) {
                var isMatchFound = task
                    .title
                    .toLowerCase()
                    .indexOf(query.toLowerCase()) > -1;

                if (isMatchFound) result.push(task);

                return result;
            }, []);

            initList(matches);
        };

        /**
         * Shows the task details.
         *
         * @taskId {string} taskId - Task id.
         */
        this.showTaskDetails = function(taskId) {

            /**
             * Shows the modal.
             *
             * @taskId {Object} tasksDetails - Tasks details.
             */
            var showModal = function(tasksDetails) {

                self.modal
                    .find('.tasks-list__modal-title')
                    .html(tasksDetails.title);

                self.modal
                    .find('.tasks-list__modal-date')
                    .html(tasksDetails.date);

                self.modal
                    .find('.tasks-list__modal-author')
                    .html(tasksDetails.author);

                self.modal
                    .find('.tasks-list__modal-status')
                    .html(tasksDetails.status);

                self.modal
                    .find('.tasks-list__modal-desc')
                    .html(tasksDetails.description);

                self.modal
                    .dialog(
                        'option',
                        'title',
                        'Информация о задаче №' + tasksDetails.id
                    )
                    .dialog("open");
            };

            var taskDetails = self.tasksDetails[taskId];

            if (taskDetails) {
                showModal(taskDetails);
            } else {
                $.ajax({
                    dataType: 'json',
                    url: '/api/v1/task/' + taskId,
                    success: function(taskDetails) {
                        showModal(taskDetails);
                        self.tasksDetails[taskId] = taskDetails;
                    }
                });
            }
        };

        initList();
        initEventListeners();
    }
})(window);
