<template>
    <div class="flex flex-col w-full h-full">
        <div class="flex flex-row justify-between bg-gray-200 p-4">
            <h2 class="text-2xl font-bold"><a href="/">Lista de Pacientes</a></h2>
            <a href="/pacientes/create" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                Novo Paciente
            </a>
        </div>

        <CreatePaciente />
    </div>
</template>
  
<script>
import axios from 'axios';
import CreatePaciente from '@/components/Pacientes/Create.vue';

export default {
    name: 'Create',
    components: {
        CreatePaciente,
    },
    data() {
        return {
            cep: '',
            logradouro: '',
            complemento: '',
            bairro: '',
            cidade: '',
            uf: ''
        };
    },
    methods: {
        getAddress() {
            if (this.cep.length !== 8) {
                alert('CEP inválido!');
                return;
            }

            axios.get(`https://viacep.com.br/ws/${this.cep}/json/`)
                .then(response => {
                    this.logradouro = response.data.logradouro;
                    this.complemento = response.data.complemento;
                    this.bairro = response.data.bairro;
                    this.cidade = response.data.localidade;
                    this.uf = response.data.uf;
                })
                .catch(error => {
                    console.error(error);
                    alert('Não foi possível consultar o CEP!');
                });
        },
        handleSubmit() {
            console.log('Endereço salvo com sucesso!');
        }
    }
};
</script>
  