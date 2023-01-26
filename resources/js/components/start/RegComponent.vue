<template>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Форма регистрации</div>
          <div class="card-body">
            <div v-if="resOk"
            class="alert alert-success p-3 mb-1" >Регистрация проведена успешно</div>
            <div v-else>
              <transition>
                <div
                  v-if="resErrorStr.length > 0"
                  class="alert alert-warning p-3 mb-1"
                >
                  {{ resErrorStr }}
                </div>
              </transition>

              <!-- resError.length {{ resError }} -->

              <div v-for="(err, pole) in resError" :key="pole">
                <transition>
                  <div class="alert alert-danger px-3 py-1 mb-1">
                    <!-- {{ pole }} :  -->
                    {{ err[0] }}
                  </div>
                </transition>
              </div>

              <!-- resError: {{ resError }}
            <br />
            resError: {{ resError.msg }}
            <br />
            resError: {{ resError.errors }} -->

              <form action="" method="post" @submit.prevent="regUser">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-4 text-end">
                      имя
                      <sup class="text-danger">*</sup>
                    </div>
                    <div class="col-8">
                      <input type="text" v-model.trim="name" class="form-control" required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4 text-end">
                      фамилия
                      <sup class="text-danger">*</sup>
                    </div>
                    <div class="col-8">
                      <input type="text" v-model.trim="family" class="form-control" required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4 text-end">
                      email
                      <sup class="text-danger">*</sup>
                    </div>
                    <div class="col-8">
                      <input type="email" v-model="email" class="form-control" required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4 text-end">
                      пароль
                      <sup class="text-danger">*</sup>
                    </div>
                    <div class="col-8">
                      <input type="password" v-model="password" class="form-control" required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4 text-end">
                      повтор пароля
                      <sup class="text-danger">*</sup>
                    </div>
                    <div class="col-8">
                      <input
                        type="password"
                        v-model="password_confirmation"
                        class="form-control" 
                        required
                      />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4 text-end"></div>
                    <div class="col-8">
                      <transition>
                        <div v-if="resLoading">... загружаю ...</div>
                        <button v-else type="submit" class="btn btn-success">
                          Отправить
                        </button>
                      </transition>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

// axios.defaults.headers.common = {
//     // 'X-Requested-With': 'XMLHttpRequest',
//     'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
// };

// поля формы
const name = ref('')
const family = ref('')
const email = ref('')
const password = ref('')
const password_confirmation = ref('')

//
const res = ref()
const resLoading = ref(false)
const resErrorStr = ref('')
const resError = ref({})
const resOk = ref(false)

// отправка данных и получение ответа
const regUser = async () => {
  // идёт загрузка данных
  resLoading.value = true
  // ошибок на старте нет
  resErrorStr.value = ''

  resError.value = {}

  await axios
    .post('/api/user/reg', {
      name: name.value,
      family: family.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
    })
    // обработка запроса норм, смотрим что получили в ответ
    .then(function (response) {
      // console.log(77,response.response);
      // console.log(7711,response.data.status);
      if (response.data.status === 'success') {
        // window.location.href = '/';
        resOk.value = true
      }

      // console.log(11, response)
      // console.log(1100, response.response.data.status)
    })
    // обработка запроса прошла неудачно
    .catch((error) => {
      // ошибка валиадции
      if (error.response.status === 422) {
        resError.value = error.response.data.errors
      }
      // каккая то другая ошибка
      else {
        // упс ... а вот и ошибка
        resError.value = error
        resErrorStr.value =
          'упс ... произошла неописуемая ситуация, повторитее попытку через пару минут'
      }
    })
    .finally((re) => {
      // загрузка закончена
      resLoading.value = false
    })
}
</script>

<style scope>
/* we will explain what these classes do next! */
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>
