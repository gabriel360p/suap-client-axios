<template>

  <div class="container">

    <div>
      <div>
        <img alt="Vue logo" src="./assets/logo.png">
      </div>
      <div>
        {{ user.nome_usual}}
      </div>
    </div>

  </div>

</template>

<script>

export default {
  name: 'App',
  components: {
    // HelloWorld
  },

  data() {
    return {
      user: {}
    }
  },

  mounted () {
    this.dataUser()
  },

  methods: {
    dataUser() {
        //recuperando os dados do usuário
        this.user=JSON.parse(localStorage.getItem("user"))
    }
  },
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
