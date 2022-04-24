<template>
  <div>
    <h2 class="text-center">Products List</h2>
    <div>
      <b-alert
        v-if="error !== null"
        :show="dismissCountDown"
        fade
        variant="success"
        @dismiss-count-down="countDownChanged"
      >
       {{ error }}! {{ dismissCountDown }}s...
      </b-alert>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Descrição</th>
          <th>Tensão</th>
          <th>Marca</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="produto in produtos" :key="produto.id">
          <td>{{ produto.id }}</td>
          <td>{{ produto.nome }}</td>
          <td>{{ produto.descricao }}</td>
          <td>{{ produto.tensao }}</td>
          <td>{{ produto.marca.descricao }}</td>
          <td>
            <div class="btn-group" role="group">
              <router-link
                :to="{ name: 'edit', params: { id: produto.id } }"
                class="btn btn-success"
                >Editar</router-link
              >
              <button class="btn btn-danger" @click="deleteProduto(produto.id)">
                Deletar
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
 
<script>
export default {
  data() {
    return {
      produtos: [],
      error: "",
      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: false,
    };
  },
  created() {
    this.axios.get("api/produto/").then((response) => {
      this.produtos = response.data;
    });
  },
  methods: {
    deleteProduto(id) {
      this.axios
        .delete(`api/produto/${id}`)
        .then((response) => {
          let i = this.produtos.map((data) => data.id).indexOf(id);
          this.produtos.splice(i, 1);
          this.error = response.data;
          this.dismissCountDown = this.dismissSecs;
          this.showAlert();
        }).finally((response) => {
            this.loading = false
        
        });
    },
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs;
    },
  },
};
</script>