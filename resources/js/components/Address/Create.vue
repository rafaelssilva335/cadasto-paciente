<template>
    <div class="">
        <div class="mb-3">
            <label class="block text-gray-700 font-bold mb-2">CEP:</label>
            <input v-model="address.cep" type="text"
                class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>
        <button type="button"
            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600"
            @click="getAddress">Buscar</button>

        <div class="mb-3">
            <label class="block text-gray-700 font-bold mb-2">Logradouro:</label>
            <input v-model="address.logradouro" type="text"
                class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>
        <div class="mb-3">
            <label class="block text-gray-700 font-bold mb-2">Complemento:</label>
            <input v-model="address.complemento" type="text"
                class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-3">
            <label class="block text-gray-700 font-bold mb-2">Bairro:</label>
            <input v-model="address.bairro" type="text"
                class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>
        <div class="mb-3">
            <label class="block text-gray-700 font-bold mb-2">Cidade:</label>
            <input v-model="address.cidade" type="text"
                class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>
        <div class="mb-3">
            <label class="block text-gray-700 font-bold mb-2">UF:</label>
            <input v-model="address.uf" type="text"
                class="w-full border border-gray-400 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>
        <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Salvar</button>
    </div>
</template>
  
<script>
import axios from 'axios'

export default {
    data() {
        return {
            address: {
                cep: '',
                logradouro: '',
                complemento: '',
                bairro: '',
                cidade: '',
                uf: ''
            }
        }
    },
    watch: {
        address: {
            handler() {
                this.handleChange()
                debugger
            },
            deep: true
        }
    },
    methods: {
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
        handleSubmit() {
            const address = {
                cep: this.cep,
                logradouro: this.logradouro,
                complemento: this.complemento,
                bairro: this.bairro,
                localidade: this.cidade,
                uf: this.uf
            }
            this.$emit('submit-address', address)
            // this.clearForm()
        },
        handleChange() {
            this.$emit('change-address', this.address)
        },
        clearForm() {
            this.cep = ''
            this.logradouro = ''
            this.complemento = ''
            this.bairro = ''
            this.cidade = ''
            this.uf = ''
        }
    }
}
</script>
  