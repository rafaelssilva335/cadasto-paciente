
<template>
  <div class="flex flex-col w-full h-full">
    <div class="flex flex-row justify-between bg-gray-200 p-4">
      <h2 class="text-2xl font-bold">Home</h2>
      <a href="/pacientes/create" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
        Novo Paciente
      </a>
      <a href="#" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded" @click.prevent="$inertia.post('/logout')">Logout</a>

    </div>

    <div class="flex flex-col mt-4 px-4">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nome
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Data de Nascimento
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    CPF
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    CNS
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Editar</span>
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Deletar</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(paciente, index) in patients" :key="paciente.id">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                          {{ paciente.name }}
                        </div>
                        <div class="text-sm text-gray-500">
                          {{ paciente.mother_name }}
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ paciente.birthdate }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ paciente.cpf }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ paciente.cns }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a :href="`${this.baseUrl}/pacientes/edit/${paciente.id}`"
                      class="text-indigo-600 hover:text-indigo-900">Editar</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PacientsMixin from '../Mixins/PacientsMixin';

export default {
  mixins: [PacientsMixin],
  data() {
    return {
      patients: [],
      baseUrl: this.$page.props.baseUrl
    };
  },
};
</script>
