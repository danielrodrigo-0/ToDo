@props([
    "id" => ''
])
{{-- @dd($id) --}}
<div class="modal fade" id="modalTeste" tabindex="-1" aria-labelledby="modalTesteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-center">
                <h1 class="modal-title fs-5 text-center text-warning" id="modalTesteLabel">Atenção!</h1>
        </div>
        <div class="modal-body">
            <p>Deseja excluir a tarefa?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="background-color: var(--bs-gray-400)" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary bg-danger">Excluir</button>
        </div>
      </div>
    </div>
  </div>
