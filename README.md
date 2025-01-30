## Teste Técnico V_Lab

Teste técnico programado para o processo seletivo do v_lab. O Sql dump se encontra na pasta dump. Para restaurar o banco é necessário utilizar o seguinte comando do pgsql:

```
$ PGPASSWORD=V_Lab!332 psql --username v_lab v_lab" < /dump/dump.sql
```

A rota para o acesso da api começa o prefixo /api/, Ex:

```
localhost:8000/api/user/transaction
```


## Modelo Entidade Relacionamento

![Alt text](photos/mer.png)
