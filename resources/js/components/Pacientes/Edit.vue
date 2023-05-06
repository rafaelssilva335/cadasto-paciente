<template>
  <div class="flex flex-col w-full h-full">
    <div class="flex flex-row justify-between bg-gray-200 p-4">
      <h2 class="text-2xl font-bold"><a href="/">Lista de Pacientes</a></h2>
      <a href="/pacientes/create" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
        Novo Paciente
      </a>
    </div>
    <div class="flex flex-col justify-center items-center">
      <form @submit.prevent="validateForm" class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3 xl:w-1/4">
        <h2 class="text-2xl font-bold mb-6">Editar dados do Paciente</h2>
        <div class="mb-4">
          <label for="name" class="block text-gray-700 font-bold mb-2">Nome:</label>
          <input v-model="name" type="text" id="name" name="name"
            class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
          <p v-if="errors.name" class="text-red-500 text-xs italic">{{ errors.name }}</p>
        </div>
        <div class="mb-4">
          <label for="mother_name" class="block text-gray-700 font-bold mb-2">Nome da mãe:</label>
          <input v-model="mother_name" type="text" id="mother_name" name="mother_name"
            class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
          <p v-if="errors.mother_name" class="text-red-500 text-xs italic">{{ errors.mother_name }}</p>
        </div>
        <div class="mb-4">
          <label for="cpf" class="block text-gray-700 font-bold mb-2">1 CPF:</label>
          <input v-mask="'###.###.###-##'" v-model="cpf" type="text" id="cpf" name="cpf"
            class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
          <p v-if="errors.cpf" class="text-red-500 text-xs italic">{{ errors.cpf }}</p>
        </div>
        <div class="mb-4">
          <label for="cns" class="block text-gray-700 font-bold mb-2">CNS:</label>
          <input v-mask="'###############'" v-model="cns" type="text" id="cns" name="cns"
            class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
          <p v-if="errors.cns" class="text-red-500 text-xs italic">{{ errors.cns }}</p>
        </div>
        <div class="mb-4">
          <label for="birthdate" class="block text-gray-700 font-bold mb-2">Data de Nascimento:</label>
          <input v-model="birthdate" type="date" id="birthdate" name="birthdate"
            class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
          <p v-if="errors.birthdate" class="text-red-500 text-xs italic">{{ errors.birthdate }}</p>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2">CEP:</label>
          <input v-mask="'########'" v-model="address.cep" type="text"
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
            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Editar</button>
        </div>
      </form>
    </div>
  </div>
</template>
  
<script>
import { mask } from 'vue-the-mask'
import AddressMixin from '../Mixins/AddressMixin';
import PacientMixin from '../Mixins/PacientMixin';

export default {
  directives: { mask },
  mixins: [
    AddressMixin, 
    PacientMixin
  ],
  data() {
    return {
      patientid: "",
      name: "",
      mother_name: "",
      cpf: "",
      birthdate: "",
      cns: "",
      address: {
        cep: '',
        logradouro: '',
        complemento: '',
        bairro: '',
        cidade: '',
        uf: ''
      },
      errors: {},
      baseUrl: this.$page.props.baseUrl
    };
  },
  methods: {
  },
};
</script>