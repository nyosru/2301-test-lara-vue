<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>
          <div class="card-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col">11</div>
                <div class="col">22</div>
              </div>
              <div class="row">
                <div class="col-4 text-end">
                  имя
                  <sup class="text-danger">*</sup>
                </div>
                <div class="col-8">
                  <input type="text" v-model="name" required />
                </div>
              </div>
              <div class="row">
                <div class="col-4 text-end">
                  фамилия
                  <sup class="text-danger">*</sup>
                </div>
                <div class="col-8">
                  <input type="text" v-model="fam" required />
                </div>
              </div>
              <div class="row">
                <div class="col-4 text-end">
                  email
                  <sup class="text-danger">*</sup>
                </div>
                <div class="col-8">
                  <input type="email" v-model="email" required />
                </div>
              </div>
              <div class="row">
                <div class="col-4 text-end">
                  пароль
                  <sup class="text-danger">*</sup>
                </div>
                <div class="col-8">
                  <input type="password" v-model="pas1" required />
                </div>
              </div>
              <div class="row">
                <div class="col-4 text-end">
                  повтор пароля
                  <sup class="text-danger">*</sup>
                </div>
                <div class="col-8">
                  <input type="password" v-model="pas2" required />
                </div>
              </div>
              <div class="row">
                <div class="col-4 text-end"></div>
                <div class="col-8">
                  <button type="support" class="success">Отправить</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

// console.log('Component mounted.')

const name = ref('')
const fam = ref('')
const email = ref('')
const pas1 = ref('')
const pas2 = ref('')

const res = ref()

const regUser = async () => {

  await axios
    .post('/user/reg', {
      firstName: 'Fred',
      lastName: 'Flintstone',
    })
    .then(function (response) {
      console.log(response)
    })
    .catch(function (error) {
      console.log(error)
    })

}
</script>
