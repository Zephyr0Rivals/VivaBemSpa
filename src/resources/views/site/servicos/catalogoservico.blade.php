<section class="pagina-servicos">
            <section class="servico site wow animate__animated animate__fadeInDown">
                <header>
                    <h2>Nossos Serviços</h2>
                    <p>Escolha a terapia ideal para desacelerar, restaurar energias e cuidar do seu bem-estar.</p>
                </header>

                <div class="site itens-servico wow animate__animated animate__fadeInDown">
                    @foreach ($listaServico as $servicoItem)
                        <a class="card-servico"
                            href="{{ route('servico.show', $servicoItem->id_servico) }}"
                            aria-label="Abrir serviço {{ $servicoItem->nome_servico }}">
                            <span class="card-servico-imagem">
                                <img src="{{ asset('vivabem-spa/assets/' . $servicoItem->imagem_servico) }}"
                                    alt="{{ $servicoItem->nome_servico }}">
                            </span>
                            <span class="card-servico-texto">{{ $servicoItem->descricao_servico }}</span>
                            <span class="card-servico-botao">Saiba Mais</span>
                        </a>
                    @endforeach
                </div>
</section>