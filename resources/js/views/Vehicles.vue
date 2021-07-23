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
          
        </template>
      </b-card>
    </b-card-group>

    <!-- Modal -->
    <b-form>

      <b-modal :title="this.formTitle()" ref="createModal" id="createModal" size="lg">
        <b-form-row>
          <!-- Placa -->
          <l-form-input
              field="placa"
              label="Placa:"
              :form="form"
              md="5">
          </l-form-input>
          <!-- UF -->

          <l-form-select
              label="UF:"
              field="uf"
              :form="form"
              :options="valuesForm['ufs']"
              md="3"
          ></l-form-select>
          <!-- Cor -->
          <l-form-input
              field="cor"
              label="Cor:"
              :form="form"
              md="4">
          </l-form-input>

          <!-- Marca-->
          <l-form-input
              field="marca"
              label="Marca:"
              :form="form"
              md="6">
          </l-form-input>
          <!-- Modelo -->

          <l-form-input
              field="modelo"
              label="Modelo:"
              :form="form"
              md="6">
          </l-form-input>
          <!--  Select Tipo-->
          <l-form-select
              label="Tipo:"
              field="tipo"
              :form="form"
              :options="valuesForm['tipos']"
              md="6"
          ></l-form-select>
          <!--  input RNTRC--> 
          <l-form-input
              field="rntrc"
              label="RNTRC:"
              :form="form"
              md="6">
          </l-form-input>

          <!--  Select Tipo de Carroceria-->
          <l-form-select
              label="Tipo de Carroceria:"
              field="tipo_carroceria"
              :form="form"
              :options="valuesForm['tiposCarroceria']"
              md="6"
          ></l-form-select>
          <!--  select tipo de Rodado -->
          <l-form-select
              label="Tipo de Rodado:"
              field="tipo_rodado"
              :form="form"
              :options="valuesForm['tiposRodado']"
              md="6"
          ></l-form-select>
          <!--  input Tara -->
          <l-form-input
              field="tara"
              label="Tara:"
              :form="form"
              md="6">
          </l-form-input>
          <!--  input Capacidade -->
          <l-form-input
              field="capacidade"
              label="Capacidade"
              :form="form"
              md="6">
          </l-form-input>
          <!--  input Nome Proprietário -->
            <l-form-input 
                field="nome_proprietario" 
                label="Nome Proprietário" 
                :form="form"
                md="12">
            </l-form-input>
          <!--  input CPF/CNPJ Proprietário -->
            <l-form-input 
                field="proprietario_documento" 
                label="CPF/CNPJ Proprietário" 
                :form="form" 
                md="6"></l-form-input>
          <!--  I.E/RG Proprietário -->
            <l-form-input 
                field="proprietario_ie" 
                label="I.E/RG Proprietário" 
                :form="form" 
                md="6">
            </l-form-input>
          <!--  select UF Proprietário -->
            <l-form-select
                label="UF Proprietário"
                field="uf_proprietario"
                :form="form"
                :options="valuesForm['ufs']"
                md="3"
            ></l-form-select>
          <!--  select tipo do Proprietário-->
            <l-form-select
                label="Tipo do Proprietário"
                field="tipo_proprietario"
                :form="form"
                :options="valuesForm['tiposProprietario']"
                md="4"
            ></l-form-select>

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
