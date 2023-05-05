<template>
  <div class="flex flex-col justify-center items-center">
    <form @submit.prevent="validateForm" class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3 xl:w-1/4">
      <h2 class="text-2xl font-bold mb-6">Cadastro de Paciente</h2>
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
          class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Salvar</button>
      </div>
    </form>
  </div>
</template>
  
<script>
import CreateAddress from '@/components/Address/Create.vue';
import axios from 'axios';
import {mask} from 'vue-the-mask'

export default {
  components: {
    CreateAddress
  },
  directives: {mask},
  data() {
    return {
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
      baseUrl:this.$page.props.baseUrl
    };
  },
  methods: {
    handleSubmit() {
      axios
        .post(`${this.baseUrl}/api/patients`, {
          name: this.name,
          mother_name: this.mother_name,
          cpf: this.cpf,
          birthdate: this.birthdate,
          address: this.address,
          cns: this.cns
        })
        .then(response => {
          console.log(response)
          alert('Paciente cadastrado com sucesso!')
          window.location.href = '/'
        })
        .catch(error => {
          console.error(error)
          alert('Erro ao cadastrar o paciente!')
        })
    },
    validateForm() {
      this.errors = {};

      if (!this.name) {
        this.errors.name = "O nome é obrigatório.";
      }

      if (!this.mother_name) {
        this.errors.mother_name = "O nome da mãe é obrigatório.";
      }

      if (!this.cpf) {
        this.errors.cpf = "O CPF é obrigatório.";
      } else if (!this.validateCPF(this.cpf)) {
        this.errors.cpf = "CPF inválido.";
      }

      if (!this.birthdate) {
        this.errors.birthdate = "A data de nascimento é obrigatória.";
      }

      if (!this.cns) {
        this.errors.cns = "O CNS é obrigatório.";
      } else if (this.cns.length !== 15) {
        this.errors.cns = "O CNS deve conter 15 dígitos.";
      }

      if (Object.keys(this.errors).length === 0) {
        this.handleSubmit();
      }
    },
    validateCPF(cpf) {
      cpf = cpf.replace(/[^\d]+/g, '');
      if (cpf === '') return false;
      if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;

      var resto;
      var soma = 0;
      for (var i = 1; i <= 9; i++) {
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
      }
      resto = (soma * 10) % 11;

      if ((resto === 10) || (resto === 11)) {
        resto = 0;
      }
      if (resto !== parseInt(cpf.substring(9, 10))) {
        return false;
      }

      soma = 0;
      for (var i = 1; i <= 10; i++) {
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
      }
      resto = (soma * 10) % 11;

      if ((resto === 10) || (resto === 11)) {
        resto = 0;
      }
      if (resto !== parseInt(cpf.substring(10, 11))) {
        return false;
      }

      return true;
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
      } catch (error) {
        console.error(error)
        alert('Erro ao consultar o ViaCEP!')
      }
    },
  },
};
</script>