{{-- Modal confirmar exclusão --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="modalTesteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h1 class="modal-title fs-5 text-center text-warning" id="modalTesteLabel">Atenção!</h1>
            </div>
            <div class="modal-body">
                <table class="d-flex justify-content-center">
                    <tr>
                        <td>Deseja realmente excluir esta tarefa?</td>
                    </tr>
                    <tr>
                        <td></br></td>
                    </tr>
                    <tr>
                        <td>Titulo: <span id="deleteModalTitle"></span></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" style="background-color: var(--bs-gray-600)" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="confirmDelete" type="button" class="btn btn-primary bg-danger">Excluir</a>
            </div>
        </div>
    </div>
</div>
{{-- Modal detalhes tarefa --}}
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title" id="taskModalLabel">Detalhes da Tarefa</h5>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div style="max-width: 75%;">
                    <p><strong>Título:</strong> <span id="taskModalTitle"></span></p>
                    <p><strong>Categoria:</strong> <span id="taskModalCategory"></span></p>
                    <p><strong>Descrição:</strong> <span id="taskModalDescription"></span></p>
                    <p><strong>Data Final:</strong> <span id="taskModalDate"></span></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary bg-success" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
