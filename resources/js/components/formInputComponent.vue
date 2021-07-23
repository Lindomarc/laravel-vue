<template>
  <b-col :md="md">
    <b-form-group :label="label" :label-for="field">
      <b-form-input v-model="form[field]" :state="validation(field)" @keydown="clearError(field)" :id="field"></b-form-input>
      <has-error :form="form" :field="field"></has-error>
    </b-form-group>
  </b-col>
</template>

<script>
import submits from "../submits";

export default {
  name:'l-form-input',
  mixins: [submits],
  props: ['field', 'label', 'form','md']
}
</script>