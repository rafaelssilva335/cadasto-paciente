import axios from 'axios';

export default {
    mounted() {
        this.getPatient()
    },
    methods: {
        updatePatient() {
            axios.put(`/api/patients/${this.patientid}`, {
                name: this.name,
                mother_name: this.mother_name,
                cpf: this.cpf,
                cns: this.cns,
                birthdate: this.birthdate,
                address: this.address
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
        getPatient() {
            this.name = this.$page.props.patient.name
            this.mother_name = this.$page.props.patient.mother_name
            this.cpf = this.$page.props.patient.cpf
            this.cns = this.$page.props.patient.cns
            this.birthdate = this.$page.props.patient.birthdate
            this.address = this.$page.props.patient.address
            this.patientid = this.$page.props.patient.id
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
            this.updatePatient();
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
        }
    }
}