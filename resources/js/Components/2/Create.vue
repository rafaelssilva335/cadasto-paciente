<template>
    <div class="container mx-auto">
      <h1>Cadastro de Paciente</h1>
      <form @submit.prevent="handleSubmit">
        <div class="mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" class="form-control" id="nome" v-model="paciente.nome" required>
        </div>
        <div class="mb-3">
          <label for="cpf" class="form-label">CPF</label>
          <input type="text" class="form-control" id="cpf" v-model="paciente.cpf" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" v-model="paciente.email" required>
        </div>
        <div class="mb-3">
          <label for="telefone" class="form-label">Telefone</label>
          <input type="tel" class="form-control" id="telefone" v-model="paciente.telefone" required>
        </div>
        <CreateAddress/>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </form>
    </div>
  </template>
  
  <script>
  import CreateAddress from '@/components/Address/Create.vue';

  export default {
    components: {
        CreateAddress
    },
    data() {
      return {
        paciente: {
          nome: '',
          cpf: '',
          email: '',
          telefone: '',
          endereco: {
            cep: '',
            logradouro: '',
            complemento: '',
            bairro: '',
            localidade: '',
            uf: ''
          }
        }
      }
    },
    methods: {
      async handleSubmit() {
        // Lógica para salvar os dados do paciente
      }
    }
  }
  </script>