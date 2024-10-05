$(document).ready(function() {
    loadTasks();

    $('#openFormBtn').on('click', function() {
        $('#backgroundOverlay').show();
        $('#popupForm').show();
        $('#formTitle').text('Create A Task');
        $('#deleteTaskBtn').hide();
        clearFields();
        setupSaveButton(false, null);
    });

    $('#closeFormBtn').on('click', function() {
        hideOverlays();
    });

    //delete function
    $(document).on('click', '.task', function() {
        $('#backgroundOverlay').show();
        $('#popupForm').show();
        $('#formTitle').text('Edit Task');
        $('#deleteTaskBtn').show();

        var currentTask = $(this); 
        var currentTitle = currentTask.find('.task-title').text();
        var currentDescription = currentTask.find('.task-description').text();
        var currentDueDate = currentTask.find('.task-due-date-display').text();

        $('#taskTitleContent').val(currentTitle);
        $('#taskDescriptionContent').val(currentDescription);
        convertDate(currentDueDate);

        setupSaveButton(true, currentTask);
        $('#deleteTaskBtn').off('click').on('click', function() {
            $('#deleteBackgroundOverlay').show();
            $('#deleteConfirmation').show();
        });
    
        $("#yesDeleteBtn").off('click').on('click', function() {
            if (currentTask) {
                var taskTitle = currentTask.find('.task-title').text(); 
        
                $.ajax({
                    url: 'delete_task.php',
                    method: 'POST',
                    data: {
                        task_title: taskTitle 
                    },
                    success: function(response) {
                        if (response === "success") {
                            currentTask.remove(); 
                            hideOverlays();
                            sortByDate();
                        } else {
                            console.error("Failed to delete task from the database.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred while deleting task: ", error);
                    }
                });
            }
        });

        $("#noDeleteBtn").off('click').on('click', function() {
            $('#deleteBackgroundOverlay').hide();
            $('#deleteConfirmation').hide();
        });
    });

        
    $(document).on('click', '.task-checkbox', function(event) {
        event.stopPropagation(); 
    });

    //checkbox
    $(document).on('change', '.task-checkbox', function() {
        var currentTask = $(this).closest('.task'); 
        var taskTitle = currentTask.find('.task-title').text(); 
        var isChecked = $(this).is(':checked'); 
    
        $.ajax({
            url: 'update_task_status.php', 
            method: 'POST',
            data: {
                task_title: taskTitle, 
                status: isChecked ? 1 : 0 
            },
            success: function(response) {
                if (response === 'success') {
                    console.log('Task status updated successfully.');
                } else {
                    console.error('Failed to update task status.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error occurred while updating task status: ', error);
            }
        });
    });
    
    
    function clearFields() {
        $('#taskTitleContent').val('');
        $('#taskDescriptionContent').val('');
        $('#taskDueDate').val('');
        checkForTasksAvailable();
    }

    function hideOverlays() {
        $('#backgroundOverlay').hide();
        $('#popupForm').hide();
        $('#deleteBackgroundOverlay').hide();
        $('#deleteConfirmation').hide();
        checkForTasksAvailable();
    }

    function checkForTasksAvailable() {
        if ($('.recycler-view .task').length === 0) 
            $('#emptyPlaceHolder').show();
        else
            $('#emptyPlaceHolder').hide();
    }

    function convertDate(displayDate) {
        let date = new Date(displayDate);
        let month = (date.getMonth() + 1).toString().padStart(2, '0');
        let day = date.getDate().toString().padStart(2, '0');
        let year = date.getFullYear();
        let formattedDate = `${year}-${month}-${day}`;
        $('#taskDueDate').val(formattedDate);
    }


    //for setting up updating and adding
    function setupSaveButton(isEditMode, currentTask) {
        $('#saveTaskBtn').off('click').on('click', function() {
            var taskTitle = $('#taskTitleContent').val();
            var taskDescription = $('#taskDescriptionContent').val();
            var taskDueDate = $('#taskDueDate').val();
    
            if (taskTitle && taskDescription && taskDueDate) {
                var formattedDate = new Date(taskDueDate).toLocaleDateString('en-US', {
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric'
                });
                //for updating a task
                if (isEditMode) {
                    if (currentTask) {
                        var oldTitle = currentTask.find('.task-title').text(); 
                        
                        $.ajax({
                            url: 'update_task.php', 
                            method: 'POST',
                            data: {
                                old_task_title: oldTitle,  
                                task_title: taskTitle, 
                                task_description: taskDescription, 
                                task_due_date: taskDueDate 
                            },
                            success: function(response) {
                                if (response === 'success') {
                                    currentTask.find('.task-title').text(taskTitle);
                                    currentTask.find('.task-description').text(taskDescription);
                                    currentTask.find('.task-due-date-display').text(formattedDate);
                                    hideOverlays();
                                    sortByDate();
                                } else {
                                    console.error("Failed to update task in the database.");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Error occurred while updating task: ", error);
                            }
                        });
                    }
                } 
                //for adding
                else {
                    $.ajax({
                        url: 'submit_task.php', 
                        method: 'POST',
                        data: {
                            task_title: taskTitle,
                            task_description: taskDescription,
                            task_due_date: taskDueDate,
                            is_edit: isEditMode, 
                        },
                        success: function(response) {
                            hideOverlays(); 
                        }
                    });
                }
                clearFields();
                hideOverlays();
            }
            sortByDate();
        });
    }
    

    function sortByDate() {
        var tasks = $('.task').get();
        tasks.sort(function(a, b) {
            var dateA = new Date($(a).find('.task-due-date-display').text());
            var dateB = new Date($(b).find('.task-due-date-display').text());
            return dateA - dateB;  
        });
        $('.recycler-view').empty().append(tasks);
    }


    //read
    function loadTasks() {
        $.ajax({
            url: 'load_tasks.php',
            method: 'GET',
            success: function (response) {
                const tasks = JSON.parse(response);
                tasks.forEach(task => {
                    var formattedDate = new Date(task.due_date).toLocaleDateString('en-US', {
                        month: 'long',
                        day: 'numeric',
                        year: 'numeric'
                    });

                    var newTask = $(`
                        <div class="task">
                            <input type="checkbox" class="task-checkbox" ${Number(task.status) === 1 ? 'checked' : ''}>
                            <div class="task-content">
                                <h2 class="task-title">${task.task_title}</h2>
                                <p class="task-description">${task.task_description}</p>
                                <div class="task-due-date" id="displayDueDate">
                                    <p class="task-due-date-display">${formattedDate}</p>
                                </div>
                            </div>
                        </div>
                    `);
                    
                    $('.recycler-view').append(newTask);
                });

                checkForTasksAvailable();
                sortByDate();
            },
            error: function (xhr, status, error) {
                console.error("Failed to load tasks: ", error);
            }
        });
    }
});