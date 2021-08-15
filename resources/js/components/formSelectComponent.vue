<template>
  <b-col :md="md">
    <b-form-group :label="label" :label-for="field">
        <v-selectize
            v-model="selected"
            :options="options"
            :id="field"
            :class="this.class"
            @submit="isValid()"
            @keydown="clearError(field)">

            <template v-slot:option="{option}" >{{ option.label }}</template>
            <template v-slot:item="{item}" v-text="item.value">{{ item.label }}</template>


        </v-selectize>
        <div>Current Value: {{ selected }}</div>

        <has-error :form="form" :field="field"></has-error>
    </b-form-group>
  </b-col>
</template>

<script>
import submits from "../submits";
import VSelectize from "@isneezy/vue-selectize";

export default {
    name: 'l-form-select',
    components: {
        VSelectize,
    },
    mixins: [submits],
    props: ['field', 'label', 'options', 'form', 'md'],
    data() {
        return {
            class: '',
            selected: this.getSelection()
        }
    },
    methods: {
        getSelection(){
            let value = this.form[this.field];
            for (let optionsKey in this.options) {
                if (this.options[optionsKey].value === parseInt(value)){
                    return this.options[optionsKey].label
                }
            }
        },
        getSelectionValue(){
            let value = this.form[this.field];
            for (let optionsKey in this.options) {
                if (this.options[optionsKey].value === parseInt(value)){
                    return this.options[optionsKey]
                }
            }
        },

        isValid() {
            this.class = this.validation(this.field) ? 'custom-select is-invalid' : '';
        }
    },
    computed: {
        selectedItems: function () {
            console.log(this.form[this.field])
            console.log(this.field)
            console.log(this.selected.value)
              this.form[this.field] = this.selected.value
        }
    }
}
</script>
