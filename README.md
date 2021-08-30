- Avviare xampp
- Creare un database chiamato taskmanager


- Lanciare il comando "php artisan migrate",  verranno create le seguenti tabelle: Users, Customers, Projects, Tasks, Roles, States, Priorities
- Users: tabella degli utenti che utilizzano il portale.
- Cutomers: tabella dei clienti.
- Projects: tabella dei progetti.
- Tasks: tabella dei task.
- Roles: tabella dei ruoli ( 1 -> Project Manager, 2 -> Developer).
- States: tabella degli stati (1 -> Backlog, 2 -> To Do, 3 -> In Progress, 4 -> Done).
- Priorities: tabella dell priorità (1 -> Low, 2 -> Medium, 3 -> High).


- Lanciare il comando "php artisan db:seed", le tabelle verranno popolate come segue:
- tabella User: vengono inseriti due utenti: manuel@pm.it con ruolo Project Manager e mario@dev1.it con ruolo Developer (per entrambi la password è 12345678).
- tabella Customers: viene creato il cliente di prova Carlo Rossi.
- Tabella Projects: viene creato un progetto di prova già assegnato all'utente di prova.
- tabella Tasks: viene creato un task associato al progetto di prova e al developer di prova Mario.

- lanciare il progetto con il comando php artisan serve

- Entrando con il profilo Project Manager (manuel@pm.it) si visualizzano 5 pulsanti:
Users, per creare/modificare gli utenti utilizzatori.
Customer, per creare/modificare i clienti.
Projects, per creare/modificare i progetti.
Tasks, per creare/modificare i task.
Overview, una tabella riepilogativa per avere un quadro d'insieme della distribuzione dei task (le colonne Task, Project e Customer sono cliccabili per accedere alla selezione corrispondente).

- Entrando con il profilo Developer (mario@dev1.it) si visualizzano 2 pulsanti:
View my Tasks, per visualizzare i task del develper. Il developer può modificare solo lo stato.
Overview, tabella riepilogativa per avere un quadro d'insieme della distribuzione dei task (le colonne Task, Project e Customer NON sono cliccabili in questo caso).

Vengono utilizzati Bootstrap e le icone Bootstrap importandole tramite link, non sono state scaricate le librerie corrispondenti e inserite nel progetto.
Per il moduo login ho utilizzato Breeze.
