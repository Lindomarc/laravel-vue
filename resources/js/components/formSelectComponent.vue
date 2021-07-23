<template>
    <b-form-group :label="label" :label-for="field">
      <v-selectize v-model="form[field]" :options="options" id="field" 
          :state="validation(field)" 
          @keydown="clearError(field)"></v-selectize>
      <has-error :form="form" :field="field"></has-error>
    </b-form-group> 
</template>

<script>
import submits from "../submits";
import VSelectize from "@isneezy/vue-selectize";

export default {
  name:'l-form-select',
  components: {
    VSelectize,
  },
  mixins: [submits],
  props: ['field', 'label','options', 'form']
}
</script>