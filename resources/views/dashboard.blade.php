<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Apresentação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    O <strong>Projeto Integrador</strong> desenvolvido pela 
                    <strong>Turma 10 do curso Técnico em Desenvolvimento de Sistemas do Senac</strong> 
                    consistiu na criação de um <strong>Sistema Hospitalar</strong> voltado para apoiar o 
                    <strong>curso de Enfermagem</strong>.<br><br>

                    O sistema oferece funcionalidades
                    <strong>simples para o primeiro contato com um sistema desse tipo</strong>. 
                    Ele foi desenvolvido em <strong>Laravel</strong>, permitindo aos alunos aplicar na prática conceitos de 
                    <em>desenvolvimento web, banco de dados, modelagem e boas práticas de programação</em>.<br><br>

                    Este trabalho proporcionou a consolidação dos conhecimentos adquiridos ao longo do curso e 
                    reforçou a importância da integração entre teoria e prática, além de mostrar como a tecnologia 
                    pode ser usada para apoiar áreas essenciais como a saúde.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
