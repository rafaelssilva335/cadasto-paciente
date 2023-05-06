import axios from 'axios';

export default {
    mounted() {
        this.getPatients()
    },
    methods: {
        async getPatients() {
            try {
                const response = await axios.get(`${this.baseUrl}/api/patients`)
                if (response.data.erro) {
                    alert('Pacientes não encontrados!')
                    return
                }
                this.patients = response.data
            } catch (error) {
                console.error(error)
                alert('Erro ao consultar o pacientes!')
            }
        },
    },
}