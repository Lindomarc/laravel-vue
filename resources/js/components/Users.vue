<template>
  <div>
    <b-card-group deck>
      <b-card header-tag="header" footer-tag="footer">
        <template #header>
          <div class="card-tools d-flex">
            <div class="group input-group-md">
              <b-button v-b-modal.createModal type="button" class="btn btn-success white" @click="clearForm()">
                <i class="fas fa-plus fa-fw"></i> Adicionar
              </b-button>
            </div>
          </div>
        </template>
        <b-table striped hover :items="items" :fields="fields" responsive="sm">

          <template #cell(actions)="row">
            <div class="d-flex justify-content-end">
              <b-button-group>
                <b-dropdown right text="" size="sm">
                  <b-dropdown-item class="btn btn-sm btn-success dropdown-item">
                    <i class=" fa fa-eye"></i> Perfil
                  </b-dropdown-item>
                  <b-dropdown-item class="btn btn-sm btn-success dropdown-item" @click="info(row.item, 'edit')">
                    <i class=" fa fa-edit"></i> Editar
                  </b-dropdown-item>
                  <b-dropdown-item class="btn btn-sm btn-danger dropdown-item">
                    <i class="fa fa-times"></i> Desativar
                  </b-dropdown-item>
                  <b-dropdown-divider></b-dropdown-divider>
                  <b-dropdown-item class="btn btn-sm btn-danger dropdown-item" @click="info(row.item, 'delete')">
                      <i class="fa fa-trash"></i> Deletar                    
                  </b-dropdown-item>
                </b-dropdown>
              </b-button-group>
            </div>
          </template>

        </b-table>
        
        <template #footer>
          <em></em>
        </template>
      </b-card>
    </b-card-group>

    <!-- Modal -->
    <form>
      
      <b-modal :title="this.formTitle()" ref="createModal"  id="createModal">

        <b-form-group id="group-name" label="Nome:" label-for="name">
          <b-form-input v-model="form.name" 
               :state="validationName('name')" id="name" aria-describedby="name-live-feedback"></b-form-input>
          <has-error :form="form" field="name"></has-error>
        </b-form-group>

        <b-form-group label="E-mail:" label-for="email">
          <b-form-input v-model="form.email" :state="validateEmail(form.email)" type="email" name="email" 
              id="email"></b-form-input>
          <has-error :form="form" field="email"></has-error>
        </b-form-group>

        <b-form-group label="Grupo" label-for="type">
          <v-selectize v-model="form.type" :options="types" id="type"></v-selectize>
          <has-error :form="form" field="type"></has-error>
        </b-form-group>

        <b-row>
          <b-col>
            <b-form-group id="group-password" label="Senha:" label-for="password">
              <b-form-input type="password" v-model="form.password" :state="validatePassword()" 
                  id="password"></b-form-input>
              <has-error :form="form" field="password"></has-error>
            </b-form-group>
          </b-col>

          <b-col>
            <b-form-group id="group-password-confirmation" label="Confirmação de Senha:" 
                label-for="password-confirmation">
              <b-form-input
                  type="password"
                  v-model="form.password_confirmation" 
                  :state="validatePasswordConfirm()" id="password-confirmation"></b-form-input>
              <has-error :form="form" field="password_confirmation"></has-error>
            </b-form-group>
          </b-col>

        </b-row>
        <template #modal-footer="{submit, cancel}">
          <b-button variant="primary" @click="create('user')">Salvar</b-button>
          <b-button variant="danger" @click="cancel()">Cancelar</b-button>
        </template>
      </b-modal>
    </form>
  </div>
</template>

<script>
import submits from "../submits";
import 'selectize/dist/css/selectize.css';
import VSelectize from '@isneezy/vue-selectize';
import {validationMixin} from "vuelidate";

export default {
  mixins: [submits, validationMixin],
  data() {
    return {
      Model:'user',
      types: [
        'admin',
        'user'
      ],
      form: new Form({
        id: '',
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        type: ''
      }),
      isEdit: false,
      formTitle: () => {
        if (this.isEdit) {
          return this.translate('Editing user')
        }
        return this.translate('Register new user')
      },
      items: [],
      fields: [
        {key: 'id', label: '#', sortable: true, sortDirection: 'desc'},
        {key: 'name', label: 'Nome', sortable: true, sortDirection: 'desc'},
        {key: 'email', label: 'E-mail', sortable: true, class: 'text-center'},
        {key: 'email_verified_at', label: 'Verificado', sortable: true, class: 'text-center'},
        {key: 'status', label: 'Status', sortable: true, class: 'text-center'},
        {key: 'actions', label: 'Actions'}
      ],    
      infoModal: {
        id: 'info-modal',
        title: '',
        content: ''
      }
    }
  },
  components: {
    VSelectize,
  },
  methods: {
    translate(key) {
      return key;
    },
    info(item, action) {
      
      if (action === 'delete') {
        this.delete(item.id, this.Model)
      }
      if (action === 'edit') {
        this.editForm(item, this.Model)
      }
      
    },
    clearForm() {
      this.isEdit = false;
      this.form.reset();
      this.form.clear();
    },
    editForm(item) {
      this.form.reset();
      this.form.clear();

      this.isEdit = true;
      this.form.fill(item);
      this.$refs['createModal'].show();
    },
    validatePassword() {
      if (this.form.password) {
        return (this.form.password.length >= 8);
      }
    },
    validatePasswordConfirm() {
      if (this.form.password && this.form.password_confirmation) {
        return (this.form.password === this.form.password_confirmation);
      }
    },
    validationName() {
      if (this.form.name) {
        return (this.form.name.length >= 3);
      }
    },
  },
  created(){
    this.listLatest(this.Model);
  }
}

</script>
