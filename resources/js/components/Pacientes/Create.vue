<template>
  <div class="flex flex-col justify-center items-center">
    <form @submit.prevent="handleSubmit" class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3 xl:w-1/4">
      <h2 class="text-2xl font-bold mb-6">Cadastro de Paciente</h2>
      <div class="mb-4">
        <label for="name" class="block text-gray-700 font-bold mb-2">Nome:</label>
        <input v-model="name" type="text" id="name" name="name"
          class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required>
      </div>
      <div class="mb-4">
        <label for="mother_name" class="block text-gray-700 font-bold mb-2">Nome da mãe:</label>
        <input v-model="mother_name" type="text" id="mother_name" name="mother_name"
          class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required>
      </div>
      <div class="mb-4">
        <label for="cpf" class="block text-gray-700 font-bold mb-2">CPF:</label>
        <input v-model="cpf" type="text" id="cpf" name="cpf"
          class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required>
      </div>
      <div class="mb-4">
        <label for="cns" class="block text-gray-700 font-bold mb-2">CNS:</label>
        <input v-model="cns" type="text" id="cns" name="cns"
          class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required>
      </div>

      
      <div class="mb-4">
        <label for="birthdate" class="block text-gray-700 font-bold mb-2">Data de Nascimento:</label>
        <input v-model="birthdate" type="date" id="birthdate" name="birthdate"
          class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">CEP:</label>
        <input v-model="address.cep" type="text"
          class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required>
      </div>
      <button type="button"
        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600"
        @click="getAddress">Buscar</button>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Logradouro:</label>
        <input v-model="address.logradouro" type="text"
          class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Complemento:</label>
        <input v-model="address.complemento" type="text"
          class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Bairro:</label>
        <input v-model="address.bairro" type="text"
          class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Cidade:</label>
        <input v-model="address.cidade" type="text"
          class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">UF:</label>
        <input v-model="address.uf" type="text"
          class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required>
      </div>
      <div class="flex justify-center">
        <button type="submit"
          class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Salvar</button>
      </div>
    </form>
  </div>
</template>
  
<script>

import CreateAddress from '@/components/Address/Create.vue';
import axios from 'axios';

export default {
  components: {
    CreateAddress
  },
  data() {
    return {
      name: "",
      mother_name: "",
      cpf: "",
      birthdate: "",
      address: {
        cep: '',
        logradouro: '',
        complemento: '',
        bairro: '',
        cidade: '',
        uf: ''
      }
    };
  },
  methods: {
    handleSubmit() {
      debugger
      axios 
        .post('http://localhost:8001/api/patients', {
          name: this.name,
          mother_name: this.mother_name,
          cpf: this.cpf,
          birthdate: this.birthdate,
          address: this.address
        })
        .then(response => {
          console.log(response)
          alert('Paciente cadastrado com sucesso!')
          this.$router.push({ name: 'pacientes' })
        })
        .catch(error => {
          console.error(error)
          // alert('Erro ao cadastrar o paciente!')
        })
    },
    handleAddess(e) {
      console.log(e)
      debugger
    },
    async getAddress() {
      try {
        const response = await axios.get(`https://viacep.com.br/ws/${this.address.cep}/json/`)
        if (response.data.erro) {
          alert('CEP não encontrado!')
          return
        }
        this.address.logradouro = response.data.logradouro
        this.address.complemento = response.data.complemento
        this.address.bairro = response.data.bairro
        this.address.cidade = response.data.localidade
        this.address.uf = response.data.uf
        this.handleSubmit()
      } catch (error) {
        console.error(error)
        alert('Erro ao consultar o ViaCEP!')
      }
    },
  },
};
</script>