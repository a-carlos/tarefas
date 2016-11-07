<form>
    <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>" />

    <fieldset>
        <legend>Nova tarefa</legend>
        <label>
            Tarefa:
            <input type="text" name="nome" value="<?php echo $tarefa['nome'];?>" />
        </label>

        <label>
            Descrição (Opcional):
            <textarea name="descricao"><?php echo $tarefa['descricao']; ?></textarea>
        </label>

        <label>
            Prazo (opcional):
            <input type="text" name="prazo"
                value="<?php echo traduz_data_para_exibir($tarefa['prazo']); ?>" />
        </label>

        <fieldset>
            <legend>Prioridade:</legend>
            <label>
                <input type="radio" name="prioridade" value="1"
                    <?php echo ($tarefa['prioridade'] == 1) ? 'checked' : ''; ?>
                /> Baixa

                <input type="radio" name="prioridade" value="2"
                    <?php echo ($tarefa['prioridade'] == 2) ? 'checked' : ''; ?>
                /> Media

                <input type="radio" name="prioridade" value="3"
                    <?php echo ($tarefa['prioridade'] == 3) ? 'checked' : ''; ?>
                /> Alta

            </label>
        </fieldset>

        <label>
            Tarefa Concluída:
            <input type="checkbox" name="concluida" value="1"
                <?php echo ($tarefa['concluida']) ? 'checked' : ''; ?>
            />
        </label>

        <input type="submit" value="<?php echo ($tarefa['id'] > 0) ? 'Atualizar' : 'Cadastrar' ?>"/>
    </fieldset>
</form>