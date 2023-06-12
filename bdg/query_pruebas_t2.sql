CREATE EXTENSION postgis

-- Crear tabla de puntos 

CREATE TABLE sitios_interes (
		  id VARCHAR (10) PRIMARY KEY NOT NULL,
		  nombre VARCHAR(80),
		  tipo VARCHAR (50),
		  geom GEOMETRY(point)
		);
		
SELECT * FROM sitios_interes
DROP TABLE sitios_interes

-- Insertar valores o puntos a la tabla 
INSERT INTO sitios_interes VALUES (1154,'Estación Naranja Bar','Bar',ST_SetSRID(ST_MakePoint(-76.5287304,3.3665456), 4326));
INSERT INTO sitios_interes VALUES (1203,'IcePub Gastro Bar','Bar',ST_SetSRID(ST_MakePoint(-76.5334481,3.363984), 4326));
INSERT INTO sitios_interes VALUES (1216,'Mister Wings Ciudad Jardin','Bar',ST_SetSRID(ST_MakePoint(-76.5356705,3.3644347), 4326));
INSERT INTO sitios_interes VALUES (1246,'ÁNGEL GASTRO BAR','Bar',ST_SetSRID(ST_MakePoint(-76.5300518,3.3483142), 4326));
INSERT INTO sitios_interes VALUES (1224,'honolulu tiki bar','Bar',ST_SetSRID(ST_MakePoint(-76.5300518,3.3483142), 4326));
INSERT INTO sitios_interes VALUES (1389,'Holguines Trade Center Centro Comercial','Centro comercial',ST_SetSRID(ST_MakePoint(-76.5394458,3.3717925), 4326));
INSERT INTO sitios_interes VALUES (1149,'Centro Comercial El Lago','Centro comercial',ST_SetSRID(ST_MakePoint(-76.5355514,3.3644065), 4326));
INSERT INTO sitios_interes VALUES (1232,'Centro Comercial Rivera Plaza','Centro comercial',ST_SetSRID(ST_MakePoint(-76.5313599,3.3628148), 4326));
INSERT INTO sitios_interes VALUES (1189,'Directv centro comercial holguines center','Centro comercial',ST_SetSRID(ST_MakePoint(-76.539786,3.3717946), 4326));
INSERT INTO sitios_interes VALUES (1117,'Centro Comercial Ciudad Jardín','Centro comercial',ST_SetSRID(ST_MakePoint(-76.5313283,3.3617296), 4326));
INSERT INTO sitios_interes VALUES (1284,'Giardino Mall','Centro comercial',ST_SetSRID(ST_MakePoint(-76.5326447,3.363855), 4326));
INSERT INTO sitios_interes VALUES (1170,'Las Velas Plaza Comercial','Centro comercial',ST_SetSRID(ST_MakePoint(-76.5335679,3.3643434), 4326));
INSERT INTO sitios_interes VALUES (1218,'Palmas Mall','Centro comercial',ST_SetSRID(ST_MakePoint(-76.5342004,3.3644835), 4326));
INSERT INTO sitios_interes VALUES (1168,'Plaza Armonia','Centro comercial',ST_SetSRID(ST_MakePoint(-76.5332384,3.3639638), 4326));
INSERT INTO sitios_interes VALUES (1165,'Navarro Giraldo e Hijos cia','Centro comercial',ST_SetSRID(ST_MakePoint(-76.5331992,3.3639627), 4326));
INSERT INTO sitios_interes VALUES (1238,'Sandra Perez','Centro comercial',ST_SetSRID(ST_MakePoint(-76.5335766,3.3644637), 4326));
INSERT INTO sitios_interes VALUES (1212,'Babilla Plaza','Centro comercial',ST_SetSRID(ST_MakePoint(-76.5349683,3.364663), 4326));
INSERT INTO sitios_interes VALUES (1113,'Centro Comercial Pance 122','Centro comercial',ST_SetSRID(ST_MakePoint(-76.5334473,3.3428163), 4326));
INSERT INTO sitios_interes VALUES (1131,'Casa Del Río','Centro comercial',ST_SetSRID(ST_MakePoint(-76.5315459,3.3649764), 4326));
INSERT INTO sitios_interes VALUES (1161,'Drogueria Comfandi Holguines Trade Center','Farmacia',ST_SetSRID(ST_MakePoint(-76.539873,3.3720109), 4326));
INSERT INTO sitios_interes VALUES (1171,'Drogueria CAFAM Trade Center','Farmacia',ST_SetSRID(ST_MakePoint(-76.5386124,3.3714637), 4326));
INSERT INTO sitios_interes VALUES (1236,'Drogueria Comfandi ciudad jardín 3','Farmacia',ST_SetSRID(ST_MakePoint(-76.5360735,3.3672703), 4326));
INSERT INTO sitios_interes VALUES (1150,'Drogueria CAFAM Carulla Ciudad Jardín','Farmacia',ST_SetSRID(ST_MakePoint(-76.5368518,3.36616), 4326));
INSERT INTO sitios_interes VALUES (1289,'Drogueria La Milagrosa','Farmacia',ST_SetSRID(ST_MakePoint(-76.539034,3.3590897), 4326));
INSERT INTO sitios_interes VALUES (1237,'Drogueria Alemana','Farmacia',ST_SetSRID(ST_MakePoint(-76.5308711,3.3659159), 4326));
INSERT INTO sitios_interes VALUES (1201,'Droguería Comfenalco Ciudad Jardín','Farmacia',ST_SetSRID(ST_MakePoint(-76.5325666,3.3641623), 4326));
INSERT INTO sitios_interes VALUES (1183,'Droguería Interdrogas Ciudad Jardín','Farmacia',ST_SetSRID(ST_MakePoint(-76.531673,3.362699), 4326));
INSERT INTO sitios_interes VALUES (1120,'Droguería Comfandi','Farmacia',ST_SetSRID(ST_MakePoint(-76.531177,3.3610146), 4326));
INSERT INTO sitios_interes VALUES (1103,'Estación de Servicio Terpel','Gasolinera',ST_SetSRID(ST_MakePoint(-76.530182,3.356898), 4326));
INSERT INTO sitios_interes VALUES (1219,'EDS Terpel Cañasgordas','Gasolinera',ST_SetSRID(ST_MakePoint(-76.5304877,3.3526789), 4326));
INSERT INTO sitios_interes VALUES (1126,'Casa Castillo Cali','Hotel',ST_SetSRID(ST_MakePoint(-76.5298156,3.3656586), 4326));
INSERT INTO sitios_interes VALUES (1155,'Hotel NH Cali Royal','Hotel',ST_SetSRID(ST_MakePoint(-76.539087,3.371202), 4326));
INSERT INTO sitios_interes VALUES (1178,'Hotel MS Ciudad Jardín Plus','Hotel',ST_SetSRID(ST_MakePoint(-76.5314941,3.3669447), 4326));
INSERT INTO sitios_interes VALUES (1184,'Babilla Suites','Hotel',ST_SetSRID(ST_MakePoint(-76.5366733,3.3664613), 4326));
INSERT INTO sitios_interes VALUES (1143,'Hotel Pance 122 Wellness spa','Hotel',ST_SetSRID(ST_MakePoint(-76.5273204,3.3432062), 4326));
INSERT INTO sitios_interes VALUES (1140,'Alko Hotel Integrado','Hotel',ST_SetSRID(ST_MakePoint(-76.5329946,3.3679683), 4326));
INSERT INTO sitios_interes VALUES (1172,'Hotel Babilla House','Hotel',ST_SetSRID(ST_MakePoint(-76.5379003,3.3615513), 4326));
INSERT INTO sitios_interes VALUES (1163,'Apartahotel La esperanza','Hotel',ST_SetSRID(ST_MakePoint(-76.5334211,3.3674132), 4326));
INSERT INTO sitios_interes VALUES (1102,'Acqua Santa Lofts Hotel','Hotel',ST_SetSRID(ST_MakePoint(-76.5305763,3.3615044), 4326));
INSERT INTO sitios_interes VALUES (1119,'Iglesia Vida Eterna','Iglesia',ST_SetSRID(ST_MakePoint(-76.5326262,3.3684856), 4326));
INSERT INTO sitios_interes VALUES (1248,'Iglesia La Transfiguración del Señor','Iglesia',ST_SetSRID(ST_MakePoint(-76.5386624,3.3597666), 4326));
INSERT INTO sitios_interes VALUES (1195,'Iglesia Cristiana Rey de Reyes','Iglesia',ST_SetSRID(ST_MakePoint(-76.5285687,3.3581864), 4326));
INSERT INTO sitios_interes VALUES (1158,'Iglesia Cristiana Internacional Ciudad Jardín','Iglesia',ST_SetSRID(ST_MakePoint(-76.531712,3.359731), 4326));
INSERT INTO sitios_interes VALUES (1226,'Iglesia La María','Iglesia',ST_SetSRID(ST_MakePoint(-76.5328262,3.3338921), 4326));
INSERT INTO sitios_interes VALUES (1135,'Iglesia Tenrikyo de Colombia','Iglesia',ST_SetSRID(ST_MakePoint(-76.5307412,3.351005), 4326));
INSERT INTO sitios_interes VALUES (1159,'Estación MIO Buitrera','Estacion',ST_SetSRID(ST_MakePoint(-76.540085,3.372239), 4326));
INSERT INTO sitios_interes VALUES (1227,'Buitrera','Estacion',ST_SetSRID(ST_MakePoint(-76.540235,3.3726817), 4326));
INSERT INTO sitios_interes VALUES (1138,'Las delicias de will&apos','Restaurante',ST_SetSRID(ST_MakePoint(-76.5330762,3.3687312), 4326));
INSERT INTO sitios_interes VALUES (1245,'Mandarino&apos Cocina Vegetariana','Restaurante',ST_SetSRID(ST_MakePoint(-76.5399819,3.3721379), 4326));
INSERT INTO sitios_interes VALUES (1166,'Restaurante El Cilindro','Restaurante',ST_SetSRID(ST_MakePoint(-76.5323177,3.3651806), 4326));
INSERT INTO sitios_interes VALUES (1202,'Aguademar Restaurante','Restaurante',ST_SetSRID(ST_MakePoint(-76.5309849,3.3675635), 4326));
INSERT INTO sitios_interes VALUES (1239,'Siel Restaurante','Restaurante',ST_SetSRID(ST_MakePoint(-76.5329946,3.3679683), 4326));
INSERT INTO sitios_interes VALUES (1124,'Chilitaco Ciudad Jardín','Restaurante',ST_SetSRID(ST_MakePoint(-76.5332946,3.36364), 4326));
INSERT INTO sitios_interes VALUES (1198,'Restaurante Valle Catalina','Restaurante',ST_SetSRID(ST_MakePoint(-76.5331992,3.3639627), 4326));
INSERT INTO sitios_interes VALUES (1186,'Pampa Malbec','Restaurante',ST_SetSRID(ST_MakePoint(-76.5335261,3.3642402), 4326));
INSERT INTO sitios_interes VALUES (1193,'El Café del Sol','Restaurante',ST_SetSRID(ST_MakePoint(-76.5342553,3.3645615), 4326));
INSERT INTO sitios_interes VALUES (1208,'Sansai Wok','Restaurante',ST_SetSRID(ST_MakePoint(-76.5370135,3.3687224), 4326));
INSERT INTO sitios_interes VALUES (1196,'Asadero y Restaurante El Paisa','Restaurante',ST_SetSRID(ST_MakePoint(-76.5269508,3.363354), 4326));
INSERT INTO sitios_interes VALUES (1194,'Carulla','Supermercado',ST_SetSRID(ST_MakePoint(-76.538658,3.371552), 4326));
INSERT INTO sitios_interes VALUES (1152,'Carulla Trade Center','Supermercado',ST_SetSRID(ST_MakePoint(-76.5404088,3.3715718), 4326));
INSERT INTO sitios_interes VALUES (1271,'Super alejo Supermercados','Supermercado',ST_SetSRID(ST_MakePoint(-76.5279707,3.3660895), 4326));
INSERT INTO sitios_interes VALUES (1125,'Supermercados Rapimerque Ciudad Jardin','Supermercado',ST_SetSRID(ST_MakePoint(-76.5323687,3.3642907), 4326));
INSERT INTO sitios_interes VALUES (1116,'Supermercado y Droguería Express Comfandi','Supermercado',ST_SetSRID(ST_MakePoint(-76.5306391,3.3530035), 4326));





		
		
