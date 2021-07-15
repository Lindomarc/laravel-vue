<template>
  <div>
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
    </div>
    <!-- Modal -->
    <modal-form :title="this.formTitle()" modal="formModal">
      <form @submit.prevent="createUser">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="name">Nome</label>
              <input 
                  v-model="form.name" 
                  type="text" 
                  name="name" 
                  placeholder="" 
                  id="name" 
                  class="form-control" 
                  :class="{ 'is-invalid': form.errors.has('name') }">
              <has-error :form="form" field="name"></has-error>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label for="email">E-mail</label>
              <input v-model="form.email" type="text" name="email" placeholder="" id="email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
              <has-error :form="form" field="email"></has-error>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label for="role">Grupo</label>
              <v-select :options="roles" name="role" id="role"></v-select>
              <has-error :form="form" field="role"></has-error>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="password">Senha</label>
              <input 
                  v-model="form.password" 
                  type="text" 
                  name="password" 
                  placeholder="" 
                  id="password" 
                  class="form-control" 
                  :class="{ 'is-invalid': form.errors.has('password') }">
              <has-error :form="form" field="password"></has-error>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="password_confirm">Confirme a Senha</label>
              <input 
                  v-model="form.password_confirm" 
                  type="text" 
                  name="password_confirm" 
                  placeholder="" 
                  id="password_confirm" 
                  class="form-control" 
                  :class="{ 'is-invalid': form.errors.has('password_confirm') }">
              <has-error :form="form" field="password_confirm"></has-error>
            </div>
          </div>
        </div>
      </form>
    </modal-form>
  </div>
</template>

<script>
    export default {
      data() {
        return {
          roles: [
            'admin',
            'user'
          ],
          form: new Form({
            name: '',
            email: '',
            password: '',
            role: '',
            bio: '',
            photo: ''
          }),
          isEdit: false,
          formTitle: () => {
            if (this.isEdit) {
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
      methods:{
        createUser(){
          this.form.post('api/user');
        }
      },
      mounted() {
        console.log('User Component mounted.')
      }
    }
</script>
