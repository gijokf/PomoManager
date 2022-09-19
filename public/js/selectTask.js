$("input:checkbox").on('click', function () {
    let $box = $(this);
    if ($box.is(":checked")) {

        let group = "input:checkbox[name='" + $box.attr("name") + "']";

        $(group).prop("checked", false);
        $box.prop("checked", true);

        $("#taskDescricao").text($box.attr("data-name"));
    } else {
        $box.prop("checked", false);
        $("#taskDescricao").text('Nenhuma tarefa selecionada...')
    }
});