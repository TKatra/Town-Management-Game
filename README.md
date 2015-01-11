# Town-Management-Game
A town management card game

This is the work for an exam I had during December 2014 and January 2015

***Change Notes(Swedish)***

population = vinstpoäng
Tool Card = verktyg
Event Card = utmaning

Spelets förlopp

3) 
* Jag har gjort att man ska alltid i början på rundor ha 5 kort på hand, istället för att få ett i taget.

4) 
* Om jag fick tid att göra detta till deadlinen, så skulle jag göra att alla skulle få dela på vinsterna och man själv skulle offra 5 i population(successpoäng).

5) 
* Jag vet inte exakt om denna delen menar att man får bonusar direckt så fort man håller i verktyget eller om du måste använda det. Jag tänker använda verktygen och få ökat sina statuspoäng.

* Senare när det gäller att vinna eller förlora så har jag gjort att flera kan vinna och även förlora. Jag har gjort så att utmaningen kan säga "ha detta värdet eller högre", då kan flera vinna utmaningen. Jag har även gjort samma sak på kriterier för förlust.

6)
* Jag har gjort att alla utmaningar ska olika effekter när du vinner, så jag gjorde en helt ny klass i php som hanterar dessa effekterna, den kan ändra statuspoäng och även säga åt spelet att ta bort kort från en spelares hand. På detta sättet gör jag det möjligt för mig att variera effekterna väldigt mycket som både utmaningar och verktyg kan göra. Detta innebär att jag inte kommer enbart vinna 15(single), 9(team) eller förlora 5. Enligt mig kommer detta göra spelet roligare.

7)
* Som jag sagt tidigare, jag har effekter som gör det möjligt för mig att ta bort kort om man skulle förlora en utmaning, så jag gör det inte på det sättet som det är skrivet i instruktionerna.

8)
* Jag har byggt upp det hela så att alla börjar med 0 population(vinstpoäng) och först till 100 vinner. I slutändan kommer spelet kolla upp vem som vann, vem som kom tvåa och vem som kom sist. Detta innebär att ingen kan totalt försvinna ut ur spelet som det står beskrivet i uppgiften.

9)
* Jag gör att när spelet är över, någon når 100 population(vinstpoäng), får spelaren ett val att starta om spelet igen, istället för att automatiskt starta om spelet.


***Implementering/Krav på kod***

(9 föremål skapas, slumpvis. Max två av samma slag.)
* Jag har skapat 15 unika typer av Tool Cards och jag skapar två av varje, istället för 9x2 verktyg.

(10 utmaningar skapas.)
* Jag har skapat 11 utmaningar.

(Datorspelarnas namn och typ slumpas. Ingen spelare ska vara av samma
typ som någon annan.)
* Jag har byggt det på så sätt att alla spelare har en stad och den innehåller alla statuspoäng.

(En spelare ska metoderna winTool, looseTool, acceptChallenge,
changeChallenge, carryOutChallenge, carryOutChallengeWith-
Companion och egenskaperna success, samt 4 olika styrkor du själv
namnger.)

* Jag har inte använt mig av dessa metodnamnen för att jag tycker inte att de passar in i min kod. De skulle göra koden obegriplig och skulle bara göra det svårare för folk att förstå den.

* Jag har 5 typer av statusar

