SELECT id_linea, 
       SUM(CASE WHEN clasificacion = '01:00 A 05:00' THEN clasificacion ELSE 0 END) AS uno_a_4,
       SUM(CASE WHEN clasificacion = '05:01 A 15:00' THEN clasificacion ELSE 0 END) AS cinco_a_14,
       SUM(CASE WHEN clasificacion = '15:01 A 30:00' THEN clasificacion ELSE 0 END) AS quince_a_29,
       SUM(CASE WHEN clasificacion = 'MAS DE 30:00' THEN clasificacion ELSE 0 END) AS mas_de_30
FROM person1

GROUP BY id_linea;


SELECT id_linea, 
       sum(CASE WHEN clasificacion = '01:00 A 05:00' THEN retardo ELSE 0 END) AS uno_a_4,
       count(CASE WHEN clasificacion = '01:00 A 05:00' THEN id_area ELSE 0 END) AS uno,
       sum(CASE WHEN clasificacion = '05:01 A 15:00' THEN retardo ELSE 0 END) AS cinco_a_14,
         count(CASE WHEN clasificacion = '05:01 A 15:00' THEN id_area ELSE 0 END) AS dos,
       sum(CASE WHEN clasificacion = '15:01 A 30:00' THEN retardo ELSE 0 END) AS quince_a_29,
        count(CASE WHEN clasificacion = '15:01 A 30:00' THEN id_area ELSE 0 END) AS tres,
       sum(CASE WHEN clasificacion = 'MAS DE 30:00' THEN retardo ELSE 0 END) AS mas_de_30,
       count(CASE WHEN clasificacion = 'MAS DE 30:00' THEN id_area ELSE 0 END) AS cuatro
FROM person1
GROUP BY id_linea;

SELECT id_linea, 
       SUM(CASE WHEN clasificacion = '01:00 A 05:00' THEN retardo ELSE 0 END) AS uno_a_4,
       SUM(CASE WHEN clasificacion = '05:01 A 15:00' THEN retardo ELSE 0 END) AS cinco_a_14,
       SUM(CASE WHEN clasificacion = '15:01 A 30:00' THEN retardo ELSE 0 END) AS quince_a_29,
       SUM(CASE WHEN clasificacion = 'MAS DE 30:00' THEN retardo ELSE 0 END) AS mas_de_30
FROM person1

GROUP BY id_linea;

SELECT id_linea, 
       COUNT(CASE WHEN clasificacion = '01:00 A 05:00' THEN 1  END) AS uno_a_4,
       COUNT(CASE WHEN clasificacion = '05:01 A 15:00' THEN 1 END) AS cinco_a_14,
       COUNT(CASE WHEN clasificacion = '15:01 A 30:00' THEN 1 END) AS quince_a_29,
       COUNT(CASE WHEN clasificacion = 'MAS DE 30:00' THEN 1 END) AS mas_de_30
FROM person1
GROUP BY id_linea;

SELECT departamento.nombre_departamento, 
       COUNT(CASE WHEN empleado.edad BETWEEN 20 AND 29 THEN 1 END) AS empleados_20_29,
       COUNT(CASE WHEN empleado.edad BETWEEN 30 AND 39 THEN 1 END) AS empleados_30_39,
       COUNT(CASE WHEN empleado.edad BETWEEN 40 AND 49 THEN 1 END) AS empleados_40_49,
       SUM(salario.monto_salario) AS total_salarios
FROM departamentos departamento
INNER JOIN empleados empleado ON departamento.id_departamento = empleado.id_departamento
INNER JOIN salarios salario ON empleado.id_empleado = salario.id_empleado
GROUP BY departamento.nombre_departamento;

<!---              query final  ------------>

SELECT id_linea, 
       
        SUM(CASE WHEN clasificacion = '01:00 A 05:00' THEN retardo ELSE 0 END) AS uno,
        COUNT(CASE WHEN clasificacion = '01:00 A 05:00' THEN 1  END) AS uno_a_4,
         SUM(CASE WHEN clasificacion = '05:01 A 15:00' THEN retardo ELSE 0 END) AS cinco,
       COUNT(CASE WHEN clasificacion = '05:01 A 15:00' THEN 1 END) AS cinco_a_14,
       SUM(CASE WHEN clasificacion = '15:01 A 30:00' THEN retardo ELSE 0 END) AS quince,
       COUNT(CASE WHEN clasificacion = '15:01 A 30:00' THEN 1 END) AS quince_a_29,
        SUM(CASE WHEN clasificacion = 'MAS DE 30:00' THEN retardo ELSE 0 END) AS mas,
       COUNT(CASE WHEN clasificacion = 'MAS DE 30:00' THEN 1 END) AS mas_de_30
FROM person1
GROUP BY id_linea;


SELECT id_linea,
		SUM(CASE WHEN clasificacion = '01:00 A 05:00' THEN clasificacion ELSE 0 END) AS uno,
		COUNT(CASE WHEN clasificacion = '01:00 A 05:00' THEN 1  END) AS Cuno, 
		SUM(CASE WHEN clasificacion = '05:01 A 15:00' THEN clasificacion ELSE 0 END) AS cinco,
		COUNT(CASE WHEN clasificacion = '05:01 A 15:00' THEN 1 END) AS Ccinco, 
		SUM(CASE WHEN clasificacion = '15:01 A 30:00' THEN clasificacion ELSE 0 END) AS quince,
		COUNT(CASE WHEN clasificacion = '15:01 A 30:00' THEN 1 END) AS Cquince, 
		SUM(CASE WHEN clasificacion = 'MAS DE 30:00' THEN clasificacion ELSE 0 END) AS mas,
		COUNT(CASE WHEN clasificacion = 'MAS DE 30:00' THEN 1 END) AS Cmas 
		FROM " . self::$tablename . " 
		GROUP BY id_linea


              SELECT id_linea, 
       
       SUM(CASE WHEN clasificacion = '01:00 A 05:00' THEN retardo ELSE 0 END) AS uno,
       COUNT(CASE WHEN clasificacion = '01:00 A 05:00' THEN 1  END) AS uno_a_4,
        SUM(CASE WHEN clasificacion = '05:01 A 15:00' THEN retardo ELSE 0 END) AS cinco,
      COUNT(CASE WHEN clasificacion = '05:01 A 15:00' THEN 1 END) AS cinco_a_14,
      SUM(CASE WHEN clasificacion = '15:01 A 30:00' THEN retardo ELSE 0 END) AS quince,
      COUNT(CASE WHEN clasificacion = '15:01 A 30:00' THEN 1 END) AS quince_a_29,
       SUM(CASE WHEN clasificacion = 'MAS DE 30:00' THEN retardo ELSE 0 END) AS mas,
      COUNT(CASE WHEN clasificacion = 'MAS DE 30:00' THEN 1 END) AS mas_de_30
FROM person1
GROUP BY id_linea;    


SELECT CASE WHEN id_linea IS NULL THEN 'Total' ELSE id_linea END AS id_linea, 
        	SUM(CASE WHEN clasificacion = '01:00 A 05:00' THEN retardo ELSE 0 END) AS uno,
       		COUNT(CASE WHEN clasificacion = '01:00 A 05:00' THEN 1  END) AS uno_a_4,
        	SUM(CASE WHEN clasificacion = '05:01 A 15:00' THEN retardo ELSE 0 END) AS cinco,
      		COUNT(CASE WHEN clasificacion = '05:01 A 15:00' THEN 1 END) AS cinco_a_14,
      		SUM(CASE WHEN clasificacion = '15:01 A 30:00' THEN retardo ELSE 0 END) AS quince,
      		COUNT(CASE WHEN clasificacion = '15:01 A 30:00' THEN 1 END) AS quince_a_29,
       		SUM(CASE WHEN clasificacion = 'MAS DE 30:00' THEN retardo ELSE 0 END) AS mas,
      		COUNT(CASE WHEN clasificacion = 'MAS DE 30:00' THEN 1 END) AS mas_de_30,
			count(evento) as T_eventos, sum(retardo) as T_retardo
		FROM person1
		GROUP BY id_linea
        WITH ROLLUP;

        SELECT id_linea, 
				SUM(CASE WHEN clasificacion = '01:00 A 05:00' THEN retardo ELSE 0 END) AS uno,
		   		COUNT(CASE WHEN clasificacion = '01:00 A 05:00' THEN 1  END) AS uno_a_4,
				SUM(CASE WHEN clasificacion = '05:01 A 15:00' THEN retardo ELSE 0 END) AS cinco,
		  		COUNT(CASE WHEN clasificacion = '05:01 A 15:00' THEN 1 END) AS cinco_a_14,
		  		SUM(CASE WHEN clasificacion = '15:01 A 30:00' THEN retardo ELSE 0 END) AS quince,
		  		COUNT(CASE WHEN clasificacion = '15:01 A 30:00' THEN 1 END) AS quince_a_29,
		   		SUM(CASE WHEN clasificacion = 'MAS DE 30:00' THEN retardo ELSE 0 END) AS mas,
		  		COUNT(CASE WHEN clasificacion = 'MAS DE 30:00' THEN 1 END) AS mas_de_30,
				count(evento) as T_eventos, sum(retardo) as T_retardos
				FROM person1 where fecha>="2023-06-01" and fecha<="2023-06-14" and fecha is not NULL  
				GROUP BY id_linea order by fecha