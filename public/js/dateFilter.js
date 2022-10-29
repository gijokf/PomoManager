$(function () {
    const taskDate = $('#taskDate');
    let date = new Date();

    let year = date.getFullYear();
    let month = date.getMonth() + 1;
    let day = date.getDate();

    taskDate.val(year + '-' + month + '-' + day);

    let dateFilter = taskDate.val()

    $.ajax({
        type: "POST",
        url: "/list-tasks",
        data: {dateFilter},
        success: function (result) {
            $(".side__container.tasks").html(result)
        }
    })

    $.ajax({
        type: "POST",
        url: "/list-completed",
        data: {dateFilter},
        success: function (result) {
            $(".side__container.completed").html(result)
        }
    })

    taskDate.on('change', function () {
        dateFilter = taskDate.val()

        $.ajax({
            type: "POST",
            url: "/list-tasks",
            data: {dateFilter},
            success: function (result) {
                $(".side__container.tasks").html(result)
            }
        })

        $.ajax({
            type: "POST",
            url: "/list-completed",
            data: {dateFilter},
            success: function (result) {
                $(".side__container.completed").html(result)
            }
        })

    })
})