<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="images/title.svg" class="app-title">

    <div class="search-container">
        <input type="text" id="search" placeholder="Search for tasks~">
    </div>

    <div class="recycler-view">
        <p class="empty-placeholder" id="emptyPlaceHolder">
            <i class="material-icons">swipe_up</i>
            No Task Currently~
        </p>

        <div class="task">
            <h2 class="task-title">Huminga</h2>
            <p class="task-description"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>

            <div class="task-due-date" id="displayDueDate">
                <p>September 9, 2024</p>
            </div>
        </div>
    </div>

    <div class="fab" id="openFormBtn">
        <i class="material-icons">add</i>
    </div>

    <div class="background-overlay" id="backgroundOverlay"></div>

    <div id="popupForm" class="form-popup">
        <form action="#" class="form-container">
            <br>
            <h2 align="center" id="formTitle">
                Create A Task
            </h2>

            <label for="taskTitleContent">
                <i class="material-icons">draw</i>
                Task Title
            </label>
            <br>
            <input type="text" 
                    placeholder="Enter Task Title" 
                    id="taskTitleContent" 
                    required
                    autocomplete="off">

            <br>
            <label for="taskDescriptionContent">
                <i class="material-icons">description</i>    
                Task Description
            </label>
            <textarea 
                    placeholder="Enter Task Description" 
                    id="taskDescriptionContent"
                    required
                    autocomplete="off"></textarea>

            <label>
                <i class="material-icons">edit_calendar</i>
                Set Due Date~
            </label>
            <br>
            <input type="date" id="taskDueDate" required>

            <button type="button" class="btn-save" id="saveTaskBtn">Save</button>

            <span class="button-container">
                <button type="button" class="btn-delete" id="deleteTaskBtn">
                    <i class="material-icons">delete</i>
                </button>

                <button type="button" class="btn-close" id="closeFormBtn">
                    <i class="material-icons">close</i>
                </button>
            </span>

            <div id="deleteConfirmation" class="delete-confirmation">
                <p>Are you sure you want to delete this task?</p>
                <div class="decision-delete-container">
                    <br>
                    <button type="button" class="btn-yes-delete" id="yesDeleteBtn">
                        Yes
                    </button>

                    <button type="button" class="btn-no-delete" id="noDeleteBtn">
                        No
                    </button>
                </div>
            </div>

            <div class="delete-background-overlay" id="deleteBackgroundOverlay"></div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="function.js"></script>
</body>
</html>