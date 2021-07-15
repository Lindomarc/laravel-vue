<template>
  <div>
    <b-card-group deck>
      <b-card header-tag="header" footer-tag="footer">
        <template #header>
          <div class="card-tools d-flex">
            <div class="group input-group-md">
              <b-button v-b-modal.addUser type="button" class="btn btn-success white">
                <i class="fas fa-plus fa-fw"></i> Adicionar
              </b-button>
            </div>
          </div>
        </template>
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
              <b-button-group size="sm">
                <b-dropdown right text="" >
                  <b-dropdown-item class="btn btn-success dropdown-item">
                    <i class=" fa fa-eye"></i> Perfil
                  </b-dropdown-item>
                  <b-dropdown-item class="btn btn-success dropdown-item">
                    <i class=" fa fa-edit"></i> Editar
                  </b-dropdown-item>
                  <b-dropdown-item class="btn btn-danger dropdown-item">
                    <i class="fa fa-times"></i> Desativar
                  </b-dropdown-item>
                  <b-dropdown-item class="btn btn-danger dropdown-item">
                    <i class="fa fa-trash"></i> Deletar
                  </b-dropdown-item>
                </b-dropdown>
              </b-button-group>
            </td>
          </tr>
          </tbody>
        </table>
        <template #footer>
          <em></em>
        </template>
      </b-card>
    </b-card-group>

    <!-- Modal -->
    <form @submit.prevent="create('user')">
      <b-modal :title="this.formTitle()" id="addUser">

        <b-form-group id="group-name" label="Nome:" label-for="name">
          <b-form-input v-model="form.name" :state="validationName" id="name"></b-form-input>
        </b-form-group>

        <b-form-group label="E-mail:" label-for="email">
          <b-form-input v-model="form.email" type="email" name="email" :state="validateEmail" id="email"></b-form-input>
          <has-error :form="form" field="email"></has-error>
        </b-form-group>

        <b-form-group label="Grupo" label-for="role">
          <v-selectize v-model="form.role" :options="roles" :state="validatePassword" id="role" required></v-selectize>
          <has-error :form="form" field="role"></has-error>
        </b-form-group>

        <b-row>
          <b-col>
            <b-form-group id="group-password" label="Senha:" label-for="password">
              <b-form-input v-model="form.password" :state="validatePassword" id="password"></b-form-input>
            </b-form-group>
          </b-col>

          <b-col>
            <b-form-group id="group-password-confirm" label="Confirmação de Senha:" label-for="password-confirm">
              <b-form-input v-model="form.password_confirm" :state="validatePasswordConfirm" id="password-confirm"></b-form-input>
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
import mixins from "../submits";
import 'selectize/dist/css/selectize.css';
import VSelectize from '@isneezy/vue-selectize';

export default {
  mixins: [mixins],
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
        password_confirm: '',
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
  components: {
    VSelectize
  },
  computed: {
    validationName() {
      return (this.form.name.length >= 3)
    },
    validateEmail() {
      let parse_mail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return parse_mail.test(this.form.email);
    },
    validatePassword() {
      return (this.form.name.length >= 8)
    },
    validatePasswordConfirm() {
      return (this.form.password === this.form.password_confirm);
    }
  },
  methods: {},
  mounted() {

    //console.log('User Component mounted.')
  }
}
</script>
