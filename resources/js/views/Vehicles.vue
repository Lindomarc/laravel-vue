<template>
  <div>
    <b-card-group deck>
      <b-card header-tag="header" header-tag-nav style="height: 100%" footer-tag="footer">
        <template #header>

          <b-navbar toggleable="md">
            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
              <b-navbar-nav>
                <b-nav-item>
                  <b-button v-b-modal.createModal type="button" class="btn btn-success white" @click="clearForm()">
                    <i class="fas fa-plus fa-fw"></i> {{ translate('Add') }}
                  </b-button>
                </b-nav-item>
              </b-navbar-nav>
            </b-collapse>

            <b-navbar-nav class="ml-auto">
              <b-nav-item right>
                <b-button-group size="sm">
                  <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" first-text="⏮" prev-text="⏪" next-text="⏩" last-text="⏭" align="left" @change="getResults"></b-pagination>
                </b-button-group>
              </b-nav-item>
            </b-navbar-nav>

          </b-navbar>
        </template>

        <b-table striped hover :items="items.data" :fields="fields" responsive="sm" :current-page="currentPage">

          <template #cell(actions)="row">
            <div class="d-flex justify-content-end">
              <b-button-group>
                <b-dropdown right text="" size="sm">
                  <b-dropdown-item class="btn btn-sm btn-success dropdown-item" @click="info(row.item, 'edit')">
                    <i class=" fa fa-edit"></i> {{ translate('Edit') }}
                  </b-dropdown-item>
                  <b-dropdown-item class="btn btn-sm btn-danger dropdown-item">
                    <i class="fa fa-times"></i> {{ translate('Disable') }}
                  </b-dropdown-item>
                  <b-dropdown-divider></b-dropdown-divider>
                  <b-dropdown-item class="btn btn-sm btn-danger dropdown-item" @click="info(row.item, 'delete')">
                    <i class="fa fa-trash"></i> {{ translate('Deletar') }}
                  </b-dropdown-item>
                </b-dropdown>
              </b-button-group>
            </div>
          </template>

        </b-table>

        <template #footer>
          <!--<pagination :data="items" -->
          <!--    align="right"-->
          <!--    @pagination-change-page="getResults"></pagination>-->

        </template>
      </b-card>
    </b-card-group>

    <!-- Modal -->
    <b-form>

      <b-modal :title="this.formTitle()" ref="createModal" id="createModal" size="lg">
        <b-form-row>
          <!-- Placa -->
          <b-col md="5">
            <b-form-group id="group-placa" label="Placa:" label-for="placa">
              <b-form-input v-model="form.placa" :state="validation('placa')" @keydown="clearError('placa')" id="placa" aria-describedby="placa-live-feedback"></b-form-input>
              <has-error :form="form" field="placa"></has-error>
            </b-form-group>
          </b-col>

          <!-- UF -->
          <b-col md="2">
            <b-form-group label="UF" label-for="uf">
              <v-selectize v-model="form.uf" :options="valuesForm['ufs']" id="uf" :state="validation('uf')" @keydown="clearError('uf')"></v-selectize>
              <has-error :form="form" field="uf"></has-error>
            </b-form-group>
          </b-col>

          <!-- Cor -->
          <b-col md="5">
            <b-form-group id="group-cor" label="Cor:" label-for="cor">
              <b-form-input v-model="form.cor" :state="validation('cor')" @keydown="clearError('cor')" id="cor" aria-describedby="cor-live-feedback"></b-form-input>
              <has-error :form="form" field="cor"></has-error>
            </b-form-group>
          </b-col>


          <!-- Marca-->
          <b-col md="6">
            <b-form-group id="group-marca" label="Marca:" label-for="marca">
              <b-form-input v-model="form.marca" :state="validation('marca')" @keydown="clearError('marca')" id="marca" aria-describedby="marca-live-feedback"></b-form-input>
              <has-error :form="form" field="marca"></has-error>
            </b-form-group>
          </b-col>

          <!-- Modelo -->
          <b-col md="6">
            <b-form-group id="group-modelo" label="Modelo:" label-for="modelo">
              <b-form-input v-model="form.modelo" :state="validation('modelo')" @keydown="clearError('modelo')" id="modelo" aria-describedby="modelo-live-feedback"></b-form-input>
              <has-error :form="form" field="modelo"></has-error>
            </b-form-group>
          </b-col>

          <!--  Select Tipo-->
          <b-col md="6">
            <b-form-group label="Tipo:" label-for="tipo">
              <v-selectize v-model="form.tipo" :options="valuesForm['tipos']" id="tipo" :state="validation('tipo')" @keydown="clearError('tipo')"></v-selectize>
              <has-error :form="form" field="tipo"></has-error>
            </b-form-group>
          </b-col>
          <!--  input RNTRC-->
          <b-col md="6">
            <b-form-group id="group-rntrc" label="RNTRC:" label-for="modelo">
              <b-form-input v-model="form.rntrc" :state="validation('rntrc')" @keydown="clearError('rntrc')" id="rntrc" aria-describedby="rntrc-live-feedback"></b-form-input>
              <has-error :form="form" field="rntrc"></has-error>
            </b-form-group>
          </b-col>

          <!--  Select Tipo de Carroceria-->
          <b-col md="6">
            <b-form-group label="Tipo de Carroceria:" label-for="tipo-carroceria">
              <v-selectize v-model="form.tipo_carroceria" :options="valuesForm['tiposCarroceria']" id="tipo-carroceria" :state="validation('tipo_carroceria')" @keydown="clearError('tipo_carroceria')"></v-selectize>
              <has-error :form="form" field="tipo_carroceria"></has-error>
            </b-form-group>
          </b-col>
          <!--  select tipo de Rodado -->
          <b-col md="6">
            <b-form-group label="Tipo de Rodado:" label-for="tipo-rodado">
              <v-selectize v-model="form.tipo_rodado" :options="valuesForm['tiposRodado']" id="tipo-rodado" :state="validation('tipo_rodado')" @keydown="clearError('tipo_rodado')"></v-selectize>
              <has-error :form="form" field="tipo_rodado"></has-error>
            </b-form-group>
          </b-col>
          <!--  input Tara -->
          <b-col md="6">
            <b-form-group id="group-tara" label="Tara:" label-for="tara">
              <b-form-input v-model="form.tara" :state="validation('tara')" @keydown="clearError('tara')" id="tara" aria-describedby="tara-live-feedback"></b-form-input>
              <has-error :form="form" field="tara"></has-error>
            </b-form-group>
          </b-col>
          <!--  input Capacidade -->

          <b-col md="6">
            <b-form-group id="group-capacidade" label="Capacidade:" label-for="capacidade">
              <b-form-input v-model="form.capacidade" :state="validation('capacidade')" @keydown="clearError('capacidade')" id="capacidade" aria-describedby="capacidade-live-feedback"></b-form-input>
              <has-error :form="form" field="capacidade"></has-error>
            </b-form-group>
          </b-col>
          <!--  input Nome Proprietário -->
          <b-col md="12">
            <l-form-input field="nome_proprietario" label="Nome Proprietário" :form="form"></l-form-input>
          </b-col>
          <!--  input CPF/CNPJ Proprietário -->
          <b-col md="6">
            <l-form-input field="proprietario_documento" label="input CPF/CNPJ Proprietário" :form="form"></l-form-input>
          </b-col>
          <!--  I.E/RG Proprietário -->
          <b-col md="6">
            <l-form-input field="proprietario_ie" label="input I.E/RG Proprietário" :form="form"></l-form-input>
          </b-col>
          <!--  select UF Proprietário -->
          <b-col md="3">
            <l-form-select
                label="UF Proprietário"
                field="uf_proprietario"
                :form="form"
                :options="valuesForm['ufs']"
            ></l-form-select>
          </b-col>
          <!--  select tipo do Proprietário-->
          <b-col md="4">
            <l-form-select
                label="Tipo do Proprietário"
                field="tipo_proprietario"
                :form="form"
                :options="valuesForm['tiposProprietario']"
            ></l-form-select>
          </b-col>

        </b-form-row>

        <template #modal-footer="{submit, cancel}">
          <b-button variant="primary" @click="create(Model)">Salvar</b-button>
          <b-button variant="danger" @click="cancel()">Cancelar</b-button>
        </template>
      </b-modal>

    </b-form>
  </div>
</template>

<script>
import submits from "../submits";
import 'selectize/dist/css/selectize.css';
import VSelectize from '@isneezy/vue-selectize';
import {validationMixin} from "vuelidate";

import LFormInput from "../components/formInputComponent";
import LFormSelect from "../components/formSelectComponent";


export default {
  components: {
    LFormSelect,
    LFormInput,
    VSelectize,
  },
  mixins: [submits, validationMixin],
  data() {
    return {
      links: {},
      rows: 1,
      perPage: 3,
      currentPage: 1,
      Model: 'vehicle',
      form: new Form({
        id: '',
        placa: '',
        uf: '',
        cor: '',
        marca: '',
        modelo: '',
        rntrc: '',
        tipo: '',
        tipo_carroceira: '',
        tipo_rodado: '',
        tara: '',
        capacidade: '',
        proprietario_documento: '',
        proprietario_nome: '',
        proprietario_ie: '',
        proprietario_uf: '',
        proprietario_tp: ''
      }),
      valuesForm: {},
      errors: {},
      isEdit: false,
      formTitle: () => {
        if (this.isEdit) {
          return this.translate('Editando veículo')
        }
        return 'Registar novo veículo'
      },
      items: {},
      fields: [
        {
          key: 'id',
          label: '#',
          sortable: true,
          sortDirection: 'desc'
        },
        {
          key: 'actions',
          label: this.translate('Actions')
        }
      ],
      infoModal: {
        id: 'info-modal',
        title: '',
        content: ''
      }
    }
  },
  mounted() {
    this.getResults();
    this.loadValuesForm();
  },
}

</script>
