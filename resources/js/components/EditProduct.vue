<template>
  <div>
    <h3 class="text-center">Editar Eletrodoméstico</h3>
    <div v-for="(v, k) in errors" :key="k">
      <p v-for="error in v" :key="error">
        <b-alert
          :show="dismissCountDown"
          fade
          variant="danger"
          @dismiss-count-down="countDownChanged"
        >
          Erro! {{ error }}! {{ dismissCountDown }}s...
        </b-alert>
      </p>
    </div>
    <div class="row">
      <div class="col-md-6">
        <form method="POST" @submit.prevent="updateProduto">
          <div class="form-group">
            <label>Nome*</label>
            <input
              type="text"
              class="form-control input"
              id="nome"
              name="nome"
              v-model="produto.nome"
            />
          </div>

          <div class="form-group">
            <label>Descrição *</label>
            <input
              type="text"
              class="form-control"
              v-model="produto.descricao"
            />
          </div>
          <div class="form-group">
            <label>Tensão</label>
            <input type="text" class="form-control" v-model="produto.tensao" />
          </div>
          <div class="form-group">
            <label>Marca *</label>
            <select class="form-control" v-model="produto.marca_id">
              <option selected value="">Selecionar</option>
              <option v-for="data in marcas" :value="data.id">
                {{ data.descricao }}
              </option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</template>
 
<script>
export default {
  data() {
    return {
      produto: {},
      marca: "",
      marcas: [],
      errors: null,
      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: false,
    };
  },
  created() {
    this.axios
      .get(`http://localhost:8080/api/produto/${this.$route.params.id}`)
      .then((res) => {
        this.getMarcas();
        this.produto = res.data;
        this.showAlert();
      });
  },
  methods: {
    updateProduto() {
      this.axios
        .patch(
          `/api/produto/${this.$route.params.id}`,
          this.produto
        )
        .then((res) => {
          this.$router.push({ name: "home" });
        })
        .catch((error) => {
          this.errors = error.response.data;
          this.dismissCountDown = this.dismissSecs;
          this.showAlert();
        });
    },
    getMarcas: function () {
      axios.get("/api/produto/create").then(
        function (response) {
          this.marcas = response.data;
        }.bind(this)
      );
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