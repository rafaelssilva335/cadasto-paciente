<template>
    <div class="p-4">
        <CreatePaciente/>
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
            // Aqui você pode enviar os dados do endereço para a API do seu backend
            console.log('Endereço salvo com sucesso!');
        }
    }
};
</script>
  