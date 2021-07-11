<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Usuários</h3>
          <div class="card-tools">
            <div class="input-group input-group-md">


              <button type="button" class="btn btn-success white" data-toggle="modal" data-target="#formModal" @click="addModal = true">
                <i class="fas fa-plus fa-fw"></i> Adicionar
              </button>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
            <tr>
              <th v-for="field in tableFields" :name="field">{{ field }}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>183</td>
              <td>John Doe</td>
              <td>John@host.com</td>
              <td><span class="tag tag-success">x</span></td>
              <td><span class="tag tag-success">x</span></td>
              <td class="d-flex justify-content-end">
                <div class="btn-group btn-group-sm" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class=" fa fa-cogs"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <button class="btn btn-success dropdown-item">
                      <i class=" fa fa-eye"></i> Perfil
                    </button>
                    <button class="btn btn-success dropdown-item">
                      <i class=" fa fa-edit"></i> Editar
                    </button>
                    <button class="btn btn-danger dropdown-item">
                      <i class="fa fa-times"></i> Desativar
                    </button>
                    <button class="btn btn-danger dropdown-item">
                      <i class="fa fa-trash"></i> Deletar
                    </button>
                  </div>
                </div>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">

        </div>
        <!--  /.card-footer -->
      </div>
      <!-- /.card -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <form>
          <div class="modal-content">
            <div class="card-header">
              <h5 class="card-title" id="formModalLabel">{{ this.formTitle() }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="card-body">
              <div class="row">
                ..
                
              </div>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary">Salvar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      data() {
        return {
          isEdit:false,
          formTitle: ()=>{
            if(this.isEdit){
              return 'Editando Usuário'
            }
            return 'Novo Usuário'
          },
          tableFields: ['#', 'Nome', 'Email', 'Verificado', 'Status', ''],
          groceryList: [
            {id: 0, text: 'Vegetables'},
            {id: 1, text: 'Cheese'},
            {id: 2, text: 'Whatever else humans are supposed to eat'}
          ]
        }
      },
      mounted() {
        console.log('Component mounted.')
      }
    }
</script>
