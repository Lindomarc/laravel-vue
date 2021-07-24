<template>
  <b-col :md="md">
    <b-form-group :label="label" :label-for="field">
      <b-form-select
          v-model="form[field]" 
          :options="options" 
          :id="field"
          :class="this.class"
          @state="isValid()"
          @keydown="clearError(field)"></v-selectize>
      </b-form-select>
      <has-error :form="form" :field="field" ></has-error>
      <b-form-invalid-feedback></b-form-invalid-feedback>
    </b-form-group>
  </b-col>
</template>

<script>
import submits from "../submits";
import VSelectize from "@isneezy/vue-selectize";

export default {
  name:'l-b-form-select',
  components: {
    VSelectize,
  },
  mixins: [submits],
  props: ['field', 'label','options', 'form', 'md'],
  data(){
    return {
      class:''
    }
  },
  methods:{
    isValid(){
      
       this.class = this.validation(this.field)?'custom-select is-invalid':'';
    }
  }
}
</script>