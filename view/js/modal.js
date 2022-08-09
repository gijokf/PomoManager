// Modal de inserção
const abrir = document.getElementById('open');
const modal_container = document.getElementById('modal_container');
const fechar = document.getElementById('close');

abrir.addEventListener('click', () => {
    modal_container.classList.add('show');
});

fechar.addEventListener('click', () => {
    modal_container.classList.remove('show');
});

// Modal de edição
function abrirAlterar() {
    const open_edit = document.getElementById('open-edit');
    const modal_container_edit = document.getElementById('modal_container_edit');
    const close_edit = document.getElementById('close-edit');
    const idEdit = document.getElementById('open-edit').value;

    modal_container_edit.querySelector('#idEdit').value = idEdit;

    open_edit.addEventListener('click', () => {
        modal_container_edit.classList.add('show');
    });

    close_edit.addEventListener('click', () => {
        modal_container_edit.classList.remove('show');
    });
}

// Modal de deleção
function abrirDeletar() {
    const open_delete = document.getElementById('open-delete');
    const modal_container_delete = document.getElementById('modal_container_delete');
    const close_delete = document.getElementById('close-delete');
    const idDelete = document.getElementById('open-delete').value;

    modal_container_delete.querySelector('#idDelete').value = idDelete;

    open_delete.addEventListener('click', () => {
        modal_container_delete.classList.add('show');
    });

    close_delete.addEventListener('click', () => {
        modal_container_delete.classList.remove('show');
    });
}