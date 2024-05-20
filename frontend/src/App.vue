<template>
  <div id="app" class="container">
    <h1>Shipping Cost Calculator</h1>
    <div class="form-group">
      <label for="weight">Weight (kg):</label>
      <input type="number" id="weight" v-model="weight" class="form-control">
    </div>
    <div class="form-group">
      <label for="carrier">Select Carrier:</label>
      <select id="carrier" v-model="selectedCarrier" class="form-control">
        <option v-for="carrier in carriers" :value="carrier" :key="carrier">{{ carrier }}</option>
      </select>
    </div>
    <button @click="calculatePrice" class="btn btn-primary">Calculate Price</button>
    <div v-if="cost !== null" class="alert alert-info mt-3">
      <p>Shipping Cost: {{ cost }} EUR</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      weight: null,
      selectedCarrier: null,
      cost: null,
      carriers: []
    };
  },
  created() {
    this.fetchCarriers();
  },
  methods: {
    fetchCarriers() {
      fetch('/api/carriers_slag')
          .then(response => response.json())
          .then(data => {
            this.carriers = data.carriers;
            this.selectedCarrier = this.carriers.length > 0 ? this.carriers[0] : null;
          })
          .catch(error => {
            console.error('Error fetching carriers:', error);
          });
    },
    calculatePrice() {
      if (!this.selectedCarrier) {
        console.error('No carrier selected');
        return;
      }

      fetch('/api/calculate', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          weight: this.weight,
          carrier: this.selectedCarrier
        })
      })
          .then(response => response.json())
          .then(data => {
            this.cost = data.cost;
          })
          .catch(error => {
            console.error('Error:', error);
          });
    }
  }
};
</script>

<style>
@import url('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');

#app {
  font-family: Arial, sans-serif;
  text-align: center;
  margin-top: 20px;
}
</style>
