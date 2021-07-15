<template>
  <div class="form-group">
    <label v-bind:for="name">{{label}}</label>
    <input
        v-model="model"
        v-bind:type="type" 
        v-bind:name="name" 
        v-bind:id="name" 
        class="form-control">
        <!--:class="{ 'is-invalid': form.errors.has(model)">-->
    
    <has-error :form="form" field="name"></has-error>
  </div>
</template>

<script>
export default {
  props: ['label','type','name','model','form'],
  data(){
  },
  mounted() {
    console.log(this)
    // console.log('Modal Component mounted.')
  }
}
</script>
