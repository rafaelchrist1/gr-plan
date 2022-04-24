<template>
  <div>
    <h3 class="text-center">Novo eletrodoméstico</h3>
    <div v-for="(v, k) in errors" :key="k">
      <p v-for="error in v" :key="error">

    <b-alert
      :show="dismissCountDown"
      fade
      variant="danger"
      @dismiss-count-down="countDownChanged"
    >
     Erro! {{error}}! {{ dismissCountDown }}s...
    </b-alert>
      </p>
    </div>
    <div class="row">
      <div class="col-md-6">
        <form method="POST" @submit.prevent="addProduto">
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
      marca: '',
      marcas: [],
      errors: null,
      dismissSecs: 5,
      dismissCountDown: 0,
      showDismissibleAlert: false,
    };
  },
  methods: {
    addProduto() {
      axios
        .post("api/produto", this.produto)
        .then((response) => {
          this.$router.push({ name: "home" });
        })
        .catch((error) => {
          this.errors = error.response.data;
          this.dismissCountDown = this.dismissSecs;
          this.showAlert();
        })
        .finally(() => (this.loading = false));
    },
    getMarcas: function () {
      this.axios.get("api/produto/create").then(
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
  created: function () {
    this.produto.marca_id='';
    this.getMarcas();
    this.showAlert();
  },
};
</script>