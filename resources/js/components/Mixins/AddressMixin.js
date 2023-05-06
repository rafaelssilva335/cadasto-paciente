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
            },
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
            } catch (error) {
                console.error(error)
                alert('Erro ao consultar o ViaCEP!')
            }
        },
    }
}