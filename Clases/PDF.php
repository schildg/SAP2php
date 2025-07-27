<?php
 define('FPDF_FONTPATH','fpdf/font/');
 require('fpdf/fpdf.php');
 include_once ("Persona.php");
 
class PDF extends FPDF
{
	function nombre_corto(){
		$establecimiento = new Establecimiento();
		$establecimiento = $establecimiento->buscarId($_SESSION['establecimiento']);
		return $establecimiento->nombre_abreviado;
	}
	function img_izq(){
		$establecimiento = new Establecimiento();
		$establecimiento = $establecimiento->buscarId($_SESSION['establecimiento']);
		if ($establecimiento->img_izq_mime == "image/png"){
			$extension=".png";
		}else{
			$extension='.jpg';		
		}
		$arch="tmp/img_izq".$establecimiento->id.$extension;
		@unlink($arch);
		define("NAMETHUMB", $arch); 
		$fp = fopen(NAMETHUMB, "a");
		$tthumb = fwrite($fp,$establecimiento->img_izq);
		fclose($fp);
		return $arch;
	}
	function img_der(){
		$establecimiento = new Establecimiento();
		$establecimiento = $establecimiento->buscarId($_SESSION['establecimiento']);
		if ($establecimiento->img_der_mime == "image/png"){
			$extension=".png";
		}else{
			$extension='.jpg';		
		}
		$arch="tmp/img_der".$establecimiento->id.$extension;
		@unlink($arch);
		define("NAME1THUMB", $arch); 
		$fp = fopen(NAME1THUMB, "a");
		$tthumb = fwrite($fp,$establecimiento->img_der);
		fclose($fp);
	    return $arch;
	}
	function Header()
{
    //Logo
    if($this->img_izq()){
       $this->Image($this->img_izq(),10,8,40,20); 	
    }
/*    if($this->img_der()){
       $this->Image($this->img_der(),180,8,20,20);
    }*/
    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Título
    $establecimiento = new Establecimiento();
	$establecimiento = $establecimiento->buscarId($_SESSION['establecimiento']);
	$this->Cell(220,8,$establecimiento->nombre_abreviado,0,1,'C');
    $this->Cell(220,8,$establecimiento->nombre,0,1,'C');
    $this->line(10,30,200,30);
    //Salto de línea
    $this->Ln();
}

//Pie de página
function Footer()
{
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'',0,0,'C');
}

//Cargar los datos
function LoadData($OBJETO,$QUERY_FILTRO,$SELECCION){
	$obj= MyActiveRecord::Create($OBJETO);
	$obj_list= MyActiveRecord::FindAll($OBJETO,$QUERY_FILTRO);
	$columna= MyActiveRecord::Columns($OBJETO);
	$data=array();
	foreach ($obj_list as $obj) {
		$linea=array();
		foreach ($columna as $k => $v) {
			if($SELECCION->$k and $k!='date_concurrency'){
				$linea[]=$obj->$k;
			}
		}
		$data[]=$linea;
	}
	
	include_once ("Tabla.php");
	$tabla= new Tabla();
	$aux=array();
	$lista=array();
	$j=0;
	foreach($data as $row){
		$i=0;
		$aux=$row;
		foreach ($columna as $k => $v) {
			if($SELECCION->$k and $obj->GetType($OBJETO,$k)!="timestamp"){
				if($obj->GetType($OBJETO,$k)=="tinyint"){
					if ($row[$i]){$aux[$i]="SI";}else{$aux[$i]="NO";};
				}else{
					if($obj->GetType($OBJETO,$k)=="date"){
						$aux[$i]=strtodatedmy($row[$i]);
					}else{
						if($obj->GetType($OBJETO,$k)=="char"){
							$aux[$i]=$tabla->campo($OBJETO,$k,$row[$i]);
						}else{
							if($obj->GetType($OBJETO,$k)=="char"){
								$aux[$i]=$tabla->campo($OBJETO,$k,$row[$i]);
							}else{
				   	      	  	if ($obj->esForaneo($k)){
					   	      	  	$aux[$i]=$obj->leyendaDelIdListado($k,$row[$i]);
								}else{
									$aux[$i]=$row[$i];
								}
							}
						}
					}
				}
				$i++;
			}
		}
		$lista[$j]=$aux;
		$j++;
	}

	$data=$lista;
	return $data;
}

function LoadHeader($OBJETO,$SELECCION){
	$obj= MyActiveRecord::Create($OBJETO);
	$i=0;
	$header=array('id');
	$columna= MyActiveRecord::Columns($OBJETO);
	foreach ($columna as $k => $v) {
		if($SELECCION->$k){
			$header[$i]=$obj->rotulo($k);
			$i++;
		}
	}
	return $header;
}

//Tabla coloreada
function FancyTable($header,$data,$SELECCION,$OBJETO){
    $w=array();

    for($i=0;$i<count($header);$i++)
       $w[$i]=0;

    for($i=0;$i<count($header);$i++){
    	if((strlen($header[$i])*3)>$w[$i]){
    		$w[$i]=strlen($header[$i])*3;
    	}
    }




	foreach($data as $row){
	    for($i=0;$i<count($header);$i++){
	    	if((strlen($row[$i])*2.5)>$w[$i]){
	    		$w[$i]=strlen($row[$i])*2.5;
	    	}
	    }
	}
	$sum=0;
	$tipo_pagina="P";
    for($i=0;$i<count($header);$i++){
    	$sum=$sum+$w[$i];
    	if($sum>200){
    		$tipo_pagina="L";
    		if($sum>290){
    			$w[$i]=0;
    		}
    	}
    }


    $this->AddPage($tipo_pagina);
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');

    for($i=0;$i<count($header);$i++){
    	if ($w[$i]!=0){
	        $this->Cell($w[$i],7,$header[$i],1,0,'C',1);
    	}
    }
    $this->Ln();
    //Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(02);
    $this->SetFont('');
    //Datos
    $fill=0;
    $count=0;
    foreach($data as $row){
	    $count++;
	    for($i=0;$i<count($header);$i++){
	    	if ($w[$i]!=0){
		        $this->Cell($w[$i],4,$row[$i],'LR',0,'L',$fill);
	    	}
	    }
        $this->Ln();
	    $fill=!$fill;
	    if(($count==37 and $tipo_pagina=="L") or($count==58 and $tipo_pagina=="P")){
	    	$count=0;
	    	$this->Cell(array_sum($w),0,'','T');
		    $this->AddPage($tipo_pagina);
		    //Colores, ancho de línea y fuente en negrita
		    $this->SetFillColor(255,0,0);
		    $this->SetTextColor(255);
		    $this->SetDrawColor(128,0,0);
		    $this->SetLineWidth(.3);
		    $this->SetFont('','B');
		    for($i=0;$i<count($header);$i++){
		    	if ($w[$i]!=0){
			        $this->Cell($w[$i],7,$header[$i],1,0,'C',1);
		    	}
		    }
		    $this->Ln();
		    //Restauración de colores y fuentes
		    $this->SetFillColor(224,235,255);
		    $this->SetTextColor(02);
		    $this->SetFont('');
	    }
   	}
    $this->Cell(array_sum($w),0,'','T');
	}
	
function DocPDF($id,$ECEPCCION,$OBJETO){
    $this->AddPage("P");
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(02);
    $this->SetFont('');
	$obj= MyActiveRecord::Create($OBJETO);
	$i=0;
	$header=array('id');
	$columna= MyActiveRecord::Columns($OBJETO);
	$sel1=array('id');
	$SEL = new ArrayObject($sel1);
	$seleccion = $SEL->getIterator();
	foreach ($columna as $k => $v) {
		if (!in_array($k,$ECEPCCION)){
	    	$seleccion->$k=true;
	    	$sel[$i]=true;
			$header[$i]=$obj->rotulo($k);
			$i++;
		}
	}
    $w=array();

    for($i=0;$i<count($header);$i++)
       $w[$i]=0;
	$max=0;
    for($i=0;$i<count($header);$i++){
    	if((strlen($header[$i])*3)>$max){
    		$max=strlen($header[$i])*3;
    	}
    }
	
	$data=$this->LoadData($OBJETO,"id = $id",$seleccion);

	$columna= MyActiveRecord::Columns($OBJETO);
	$i=0;
	foreach ($columna as $k => $v) {
		if (in_array($k,$sel)){
	        $this->Cell($max,7,$header[$i],0,0,'L',1);
	        $this->Cell(0,7,$data[0][$i],0,0,'L',1);
		    $this->Ln();
		    $i++;
		}
	}


    
}
function DocRegular($id,$ECEPCCION){
    $this->AddPage("P");
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(02);
    $this->SetFont('');
	$persona= new Persona();
	$persona=$persona->buscarId($id);
    $division=new Division();
    $division=$persona->buscarDivisionActual();
            if($persona->Sexo==1){
                $NACIDO='nacido el ';
            }else{   
            	$NACIDO='nacida el ';
            }
		    $this->Ln();

		    $TEXTO= '     Conste que '.$persona->nombre().' '.$NACIDO.strtodatedmy($persona->fecha_nac).' cursa durante el año '.date("Y").'  '.' el '.$division->leyendaT().' en la Escuela Tecnológica Nº1 "Conrado Etchebarne".';
            $this->SetFont('Courier','',16);
	        $this->Cell(0,16,'CONSTANCIA DE ALUMNO REGULAR',0,0,'C',1);
		    $this->Ln();
		    $this->Ln();
            $this->SetFont('Courier','',10);
			$this->write(7,$TEXTO);
		    $this->Ln();
            $this->Cell(0,7,'Villaguay,'.'....'.date(j).' de '.strftime("%B").' de '.date(Y),0,0,'L',1);
		    $this->Ln();
		    $this->Ln();
		    $this->Ln();
		    $this->Ln();
            $this->Cell(0,7,'................................................',0,0,'R',1);
		    $this->Ln();
            $this->Cell(0,7,'Sello y Firma                    ',0,0,'R',1);
}
function DocExamenFinal($id,$id_transacion){
    $this->AddPage("P");
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(02);
    $this->SetFont('');
	$alumno_cursa= new Alumno_cursa();
	$alumno_cursa=$alumno_cursa->buscarId($id);
	$persona= new Persona();
	$persona=$persona->buscarId($alumno_cursa->persona_id);
	$this->Ln();
	
	$TEXTO= '     Conste que '.$persona->nombre().', se inscribio para rendir examen final de la asignatura '.$alumno_cursa->leyenda().', mediante el numero de inscripcion '.$id_transacion;
	$this->SetFont('Courier','',16);
	$this->Cell(0,16,'CONSTANCIA DE INSCRIPCION A EXAMEN FINAL',0,0,'C',1);
	$this->Ln();
	$this->Ln();
	$this->SetFont('Courier','',10);
	$this->write(7,$TEXTO);
	$this->Ln();
	$this->Cell(0,7,'Villaguay,'.'....'.date(j).' de '.strftime("%B").' de '.date(Y),0,0,'L',1);
	$this->Ln();
	$this->Ln();
	$this->Ln();
}

function DocReinscorporacion($id){
    $this->AddPage("P");
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(02);
    $this->SetFont('');
	$legajo= new Legajo();
	$legajo=$legajo->buscarId($id);
	$persona= new Persona();
	$persona=$persona->buscarId($legajo->persona_id);
    $division=new Division();
    $legajo_docente=new Legajo_Docente();
    $legajo_materia=new Legajo_Materia();
    $division=$division->buscar($legajo->division_id);
	$legajo_materias= MyActiveRecord :: FindAll('Legajo_Materia', "legajo_id = '$legajo->id'");
	$legajo_docentes= MyActiveRecord :: FindAll('Legajo_Docente', "legajo_id = '$legajo->id'");

    $this->SetFont('Courier','',16);
    $this->Cell(0,16,'CONSTANCIA DE REINCORPORACION DEL ALUMNO',0,0,'C',1);
    $this->Ln();
    $this->Ln();
    $this->SetFont('Courier','',10);
    if($persona->Sexo==1){
         $text_alum='Alumno';
         }else{
         $text_alum='Alumna';	
         } 
    $TEXTO='El que suscribe '.$text_alum.' '.$persona->nombre().' que cursa el '.$division->leyendaT().' en la Escuela Tecnológica Nº1 "Conrado Etchebarne". el que ha quedado libre, le solicita quiera disponer su reincorporacion';
    $this->Cell(0,7,'Villaguay (E.R.),'.date('j',time($legajo->fecha_alta)).' de '.strftime('%B',time($legajo->fecha_alta)).' de '.date('Y',time($legajo->fecha_alta)),0,0,'R',1);
    $this->Ln();
    $this->Cell(0,7,'Al señor Director del establecimiento, '.$persona->director($legajo->fecha_alta).'   (S/D)',0,0,'L',1);
    $this->Ln();
	$this->write(7,$TEXTO);
    $this->Ln();
    $this->Ln();
    $this->Ln();
    $this->Cell(63,7,' -----------------------------',0,0,'C',1);
    $this->Cell(63,7,'                              ',0,0,'C',1);
    $this->Cell(63,7,' -----------------------------',0,0,'C',1);
    $this->Ln();
    $this->Cell(63,7,'Firma del Padre, Madre o Tutor',0,0,'C',1);
    $this->Cell(63,7,'                              ',0,0,'C',1);
    $this->Cell(63,7,'Firma del Alumno              ',0,0,'C',1);
    $this->Ln();
    $this->Ln();
    $this->Ln();
    $this->Cell(80,7,'ASIGNATURAS',0,0,'L',1);
    $this->Cell(30,7,'1º TRIMESTRE',0,0,'L',1);
    $this->Cell(30,7,'2º TRIMESTRE',0,0,'L',1);
    $this->Cell(30,7,'3º TRIMESTRE',0,0,'L',1);
	$this->Ln();            	
    foreach($legajo_materias as $legajo_materia){
        $materia=new Materia();
        $materia=$materia->buscar($legajo_materia->materia_id);
        $this->Cell(80,7,$materia->nombre,0,0,'L',1);
        $this->Cell(30,7,$legajo_materia->nt1,0,0,'C',1);
        $this->Cell(30,7,$legajo_materia->nt2,0,0,'C',1);
        $this->Cell(30,7,$legajo_materia->nt3,0,0,'C',1);
	    $this->Ln();            	
    };
    $this->Ln();
    $this->Cell(80,7,'AMONESTACIONES',0,0,'L',1);
    $this->Cell(80,7,$legajo->amonestaciones,0,0,'L',1);
    $this->Ln();
    $this->Cell(80,7,'FALTAS INJUSTIFICADAS',0,0,'L',1);
    $this->Cell(80,7,$legajo->inasistencia,0,0,'L',1);
    $this->Ln();
    $this->Cell(80,7,'FALTAS JUSTIFICADAS',0,0,'L',1);
    $this->Cell(80,7,$legajo->inasistencia_j,0,0,'L',1);
    $this->Ln();
    $this->write(7,'OBSERVACIONES   '.$legajo->detalle);
    $this->Ln();
    
    $this->Ln();
    $this->Cell(80,7,'Firma del Secretario y/o Pro-secretario.......................................',0,0,'L',1);
    $this->Ln();
    $auto='';
    if($legajo->autorizado==1){$auto='la reincorporacion del alumno';};
    $this->Cell(0,7,'Visto el conforme que antecede el Sr. Director y concejo consultivo resuelve en ',0,0,'L',1);
    $this->Ln();
    $this->Cell(0,7,$auto,0,0,'L',1);
    $this->Ln();
    $this->AddPage("P");

    if($persona->Sexo==1){
         $text_alum='del alumno';
         }else{
         $text_alum='de la alumna';	
         } 

	$TEXTO='La Direccion de la "'.$this->nombre_corto().'", solicita la opinion de los profesores que figuran a continuacion, en relacion a la reincorporacion '.$text_alum.' '.$persona->nombre().' que cursa el '.$division->leyendaT();
	$this->write(7,$TEXTO);
    $this->Ln();
    $this->Ln();
    $this->Ln();
    $this->Ln();

    $this->Cell(100,7,'PROFESOR',0,0,'L',1);
    $this->Cell(50,7,'FIRMA',0,0,'C',1);
    $this->Cell(30,7,'SI / NO',0,0,'C',1);
	$this->Ln();            	
    foreach($legajo_docentes as $legajo_docente){
        $docente=new Persona();
        $persona=$persona->buscar($legajo_docente->persona_id);
        $this->Cell(100,7,$persona->nombre(),0,0,'L',1);
        $this->Cell(50,7,'...........................',0,0,'C',1);
        $this->Cell(30,7,'..........',0,0,'C',1);
 	    $this->Ln();            	
    };



}

function DocPASE($id){
    $this->AddPage("P");
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(02);
    $this->SetFont('');
	$legajo= new Legajo();
	$legajo=$legajo->buscarId($id);
	$persona= new Persona();
	$persona=$persona->buscarId($legajo->persona_id);
    $division=new Division();
    $legajo_docente=new Legajo_Docente();
    $legajo_materia=new Legajo_Materia();
    $division=$division->buscar($legajo->division_id);
	$legajo_materias= MyActiveRecord :: FindAll('Legajo_Materia', "legajo_id = '$legajo->id'");
	$legajo_docentes= MyActiveRecord :: FindAll('Legajo_Docente', "legajo_id = '$legajo->id'");

    $this->SetFont('Courier','',16);
    $this->Cell(0,16,'SOLICITUD DE PASE',0,0,'C',1);
    $this->Ln();
    $this->SetFont('Courier','',10);
    if($persona->Sexo==1){
         $text_alum='Alumno';
         }else{
         $text_alum='Alumna';	
         } 
    $TEXTO='El que suscribe '.$text_alum.' '.$persona->nombre().' que cursa el '.$division->leyendaT().'. por razones de '.$legajo->razon_del_pase.' le solicita quiera disponer el pase para inscibirse en la '.$legajo->escuela_destino;
    $this->Cell(0,7,$this->nombre_corto(),0,0,'R',1);
    $this->Ln();
    $this->Cell(0,7,'Villaguay (E.R.),'.date('j',time($legajo->fecha_alta)).' de '.strftime('%B',time($legajo->fecha_alta)).' de '.date('Y',time($legajo->fecha_alta)),0,0,'R',1);
    $this->Ln();
    $this->Cell(0,7,'Al señor Director del establecimiento, '.$persona->director($legajo->fecha_alta).'   (S/D)',0,0,'L',1);
    $this->Ln();
	$this->write(7,$TEXTO);
    $this->Ln();
    $this->Cell(0,7,'Saluda atte. ',0,0,'C',1);
    $this->Ln();
    $this->Ln();
    $this->Cell(63,7,' -----------------------------',0,0,'C',1);
    $this->Cell(63,7,'                              ',0,0,'C',1);
    $this->Cell(63,7,' -----------------------------',0,0,'C',1);
    $this->Ln();
    $this->Cell(63,7,'Firma del Padre, Madre o Tutor',0,0,'C',1);
    $this->Cell(63,7,'                              ',0,0,'C',1);
    $this->Cell(63,7,'Firma del Alumno              ',0,0,'C',1);
    $this->Ln();
    $this->Ln();
    if($persona->Sexo==1){
         $text_alum='alumno';
         }else{
         $text_alum='alumna';	
         } 
    $TEXTO=$persona->nombre().' '.$text_alum.' regular de '.$division->leyendaT().', ha incurrido en '.$legajo->inasistencia.' injustificadas '.$legajo->inasistencia_j.' justificadas '.$legajo->amonestaciones.' amonestaciones, y obtubo las siguientes calificaciones en el presente año lectivo ';
	$this->write(7,$TEXTO);
    $this->Ln();
    $this->Cell(80,7,'ASIGNATURAS',0,0,'L',1);
    $this->Cell(30,7,'1º TRIMESTRE',0,0,'L',1);
    $this->Cell(30,7,'2º TRIMESTRE',0,0,'L',1);
    $this->Cell(30,7,'3º TRIMESTRE',0,0,'L',1);
	$this->Ln();            	
    foreach($legajo_materias as $legajo_materia){
        $materia=new Materia();
        $materia=$materia->buscar($legajo_materia->materia_id);
        $this->Cell(80,5,$materia->nombre,0,0,'L',1);
        $this->Cell(30,5,$legajo_materia->nt1,0,0,'C',1);
        $this->Cell(30,5,$legajo_materia->nt2,0,0,'C',1);
        $this->Cell(30,5,$legajo_materia->nt3,0,0,'C',1);
	    $this->Ln();            	
    };
    $this->Ln();
    $this->write(7,'Otros antecedentes:   '.$legajo->detalle);
    $this->Ln();
    $this->Cell(0,7,'DIRECCION',0,0,'L',1);
	$this->Ln();            	
    if($persona->Sexo==1){
         $text_alum='Alumno';
         }else{
         $text_alum='Alumna';	
         } 
    $TEXTO='        Vista la informacion que antecede, se autoriza el pase de '.$persona->nombre().' '.$text_alum.' de '.$division->leyendaT().' para la '.$legajo->escuela_destino;
    $this->write(6,$TEXTO);
    $this->Ln();
    $TEXTO='        Se deja constacia que se retira por su propia voluntad y que las calificaciones, inasistencias y demas antecedentes son los que se consignan en el anterior informe ';
    $this->write(6,$TEXTO);
    $this->Ln();
    $TEXTO='        Expidase el correspondiente certificado de estudios y a sus efectos entreguese al interesado';
    $this->write(6,$TEXTO);
    $this->Ln();
    $this->Ln();
    $this->Ln();
    $this->Cell(63,6,' -----------------------------',0,0,'C',1);
    $this->Cell(63,6,'                              ',0,0,'C',1);
    $this->Cell(63,6,' -----------------------------',0,0,'C',1);
    $this->Ln();
    $this->Cell(63,6,'Firma del Secretario          ',0,0,'C',1);
    $this->Cell(63,6,'                              ',0,0,'C',1);
    $this->Cell(63,6,'Firma del Director            ',0,0,'C',1);
    $this->Ln();



}


function DocCalificaciones($materia_id,$division_id){
    $this->AddPage("P");
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(02);
    $this->SetFont('');


	include_once ("Persona.php");
	include_once ("Division.php");
	include_once ("Materia_Division.php");
	include_once ("Materia.php");
	include_once ("Docente_Dicta.php");
	include_once ("Alumno_Cursa.php");
	include_once ("Tabla.php");
	$tabla = new Tabla();
	$alumno_cursa = new Alumno_Cursa();
	$materia_division = new Materia_Division();
	$division = new Division();
	$alumno = new Persona();
	$profesor = new Persona;
	$persona = new Persona;
	$materia = new Materia;
	$docente_dicta = new Docente_Dicta;
	$relacion=$division;
	
	
	$divi_id = $division_id;	
	$division=$division->buscar($divi_id);
	$materias=$division->materias();
	$alumnos=$division->alumnosCursan($materia_id);
	if($alumnos)
	$personas=$persona->ordenarPersonas($alumnos);
		
	
	
	if($materia_id){
	$materia=$materia->buscar($materia_id);
	$profesor= $division->docenteDicta($materia->id);
		
	}
		

    $this->SetFont('Courier','',16);
    $this->Cell(0,16,'PLANILLA DE CALIFICACIONES',0,0,'C',1);
    $this->Ln();
    $this->SetFont('Courier','',10);
    if($persona->Sexo==1){
         $text_alum='Alumno';
         }else{
         $text_alum='Alumna';	
         } 
    $this->Cell(0,7,$this->nombre_corto(),0,0,'R',1);
    $this->Ln();
    $this->Cell(40,7,'Docente',0,0,'L',1);
    $this->Cell(100,7,$profesor->nombre(),0,0,'L',1);
    $this->Ln();
    $this->Cell(40,7,'Asignatura',0,0,'L',1);
    $this->Cell(100,7,$materia->nombre,0,0,'L',1);
    $this->Ln();
    $this->Cell(40,7,'Division',0,0,'L',1);
    $this->Cell(100,7,$division->leyendaT(),0,0,'L',1);
    $this->Ln();
    $this->Ln();
    $this->Ln();
    $this->Cell(60,7,'ALUMNOS',1,0,'L',1);
    $this->Cell(19,7,'1º TRI.',1,0,'L',1);
    $this->Cell(19,7,'2º TRI.',1,0,'L',1);
    $this->Cell(19,7,'3º TRI.',1,0,'L',1);
    $this->Cell(22,7,'Prom.Anual',1,0,'L',1);
    $this->Cell(19,7,'Eval.Dic.',1,0,'L',1);
    $this->Cell(19,7,'Eval.Mar.',1,0,'L',1);
    $this->Cell(19,7,'Defin.',1,0,'L',1);
	$this->Ln();            	
    foreach($personas as $persona){
        $this->Cell(60,5,$persona->nombre(),1,0,'L',1);
        if ($persona->cursa->n1t!=0){$this->Cell(19,5,$persona->cursa->n1t,1,0,'C',1);}else{$this->Cell(19,5,'',1,0,'C',1);};
        if ($persona->cursa->n2t!=0){$this->Cell(19,5,$persona->cursa->n2t,1,0,'C',1);}else{$this->Cell(19,5,'',1,0,'C',1);};
        if ($persona->cursa->n3t!=0){$this->Cell(19,5,$persona->cursa->n3t,1,0,'C',1);}else{$this->Cell(19,5,'',1,0,'C',1);};
        if ($persona->cursa->promedio()!=0){$this->Cell(22,5,$persona->cursa->promedio(),1,0,'C',1);}else{$this->Cell(22,5,'',1,0,'C',1);};
        if ($persona->cursa->e_diciembre!=0){$this->Cell(19,5,$persona->cursa->e_diciembre,1,0,'C',1);}else{$this->Cell(19,5,'',1,0,'C',1);};
        if ($persona->cursa->e_marzo!=0){$this->Cell(19,5,$persona->cursa->e_marzo,1,0,'C',1);}else{$this->Cell(19,5,'',1,0,'C',1);};
        if ($persona->cursa->notafinal()!=0){$this->Cell(19,5,$persona->cursa->notafinal(),1,0,'C',1);}else{$this->Cell(19,5,'',1,0,'C',1);};
	    $this->Ln();            	
    };



}
function DocActaVolante($id){
    $this->AddPage("P");
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(02);
    $this->SetFont('');


	include_once ("Persona.php");
	include_once ("Division.php");
	include_once ("Materia_Division.php");
	include_once ("Materia.php");
	include_once ("Acta_Volante.php");
	include_once ("Linea_Acta_Volante.php");
	include_once ("Tabla.php");
	$tabla = new Tabla();
	$acta_volante = new Acta_Volante();
	$linea_acta_volante = new Linea_Acta_Volante();
	$materia_division = new Materia_Division();

	$acta_volante=$acta_volante->buscar($id);
	$lineas=$linea_acta_volante->FindAll('Linea_Acta_Volante',"acta_volante_id='$acta_volante->id'");
	

	$division = new Division();
	$alumno = new Persona();
	$presidente = new Persona;
	$vocal1 = new Persona;
	$vocal2 = new Persona;
	$persona = new Persona;
	$materia = new Materia;

	$division=$division->buscar($acta_volante->division_id);
	$materia=$materia->buscar($acta_volante->materia_id);
		
	$presidente=$presidente->buscar($acta_volante->persona_id1);
	$vocal1=$vocal1->buscar($acta_volante->persona_id2);
	$vocal2=$vocal2->buscar($acta_volante->persona_id3);
		

    $this->SetFont('Courier','',16);
    $this->Cell(0,16,'ACTA VOLANTE DE CALIFICACIONES',0,0,'C',1);
    $this->Ln();
    $this->SetFont('Courier','',10);
    if($persona->Sexo==1){
         $text_alum='Alumno';
         }else{
         $text_alum='Alumna';	
         } 
    $this->Cell(0,7,$this->nombre_corto(),0,0,'R',1);
    $this->Ln();
    $this->Cell(40,7,'Asignatura',0,0,'L',1);
    $this->Cell(100,7,$materia->nombre,0,0,'L',1);
    $this->Ln();
    $this->Cell(40,7,'Division',0,0,'L',1);
    $this->Cell(100,7,$division->leyendaT(),0,0,'L',1);
    $this->Ln();
    $this->Cell(40,7,'Presidente de Mesa',0,0,'L',1);
    $this->Cell(100,7,$presidente->nombre(),0,0,'L',1);
    $this->Ln();
    $this->Cell(40,7,'1º Vocal de Mesa',0,0,'L',1);
    $this->Cell(100,7,$vocal1->nombre(),0,0,'L',1);
    $this->Ln();
    $this->Cell(40,7,'2º Vocal Mesa',0,0,'L',1);
    $this->Cell(100,7,$vocal2->nombre(),0,0,'L',1);
    $this->Ln();
    $this->Ln();
    $this->Ln();
    $this->Cell(25,7,'Nº Permiso',1,0,'L',1);
    $this->Cell(90,7,'Apellido y Nombre',1,0,'L',1);
    $this->Cell(25,7,'Nota Oral',1,0,'L',1);
    $this->Cell(25,7,'Nota Esc.',1,0,'L',1);
    $this->Cell(30,7,'DNI',1,0,'L',1);
	$this->Ln();            	
    foreach($lineas as $linea){
        $this->Cell(25,5,$linea->id,1,0,'L',1);
        $alumno_cursa=new Alumno_Cursa();
		$alumno_cursa=$alumno_cursa->buscarId($linea->alumno_cursa_id);
        $persona=$persona->buscar($alumno_cursa->persona_id);
        $this->Cell(90,5,$persona->nombre(),1,0,'L',1);
        if ($linea->nota_oral!=0){$this->Cell(25,5,$linea->nota_oral,1,0,'C',1);}else{$this->Cell(25,5,'',1,0,'C',1);};
        if ($linea->nota_escrita!=0){$this->Cell(25,5,$linea->nota_escrita,1,0,'C',1);}else{$this->Cell(25,5,'',1,0,'C',1);};
        $this->Cell(30,5,$persona->DNI,1,0,'L',1);
	    $this->Ln();            	
    };



}

function PlanillaAsistencia($materia_id,$division_id,$turno_id,$fecha_1,$fecha_2,$fecha_3,$fecha_4,$fecha_5){
    $this->AddPage("P");
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(02);
    $this->SetFont('');


    include_once ("Persona.php");
    include_once ("Division.php");
    include_once ("Materia_Division.php");
    include_once ("Alumno_Cursa.php");
    include_once ("Tabla.php");
 	include_once ("Materia.php");
	include_once ("Docente_Dicta.php");

	$profesor = new Persona;
	$materia = new Materia;
	$docente_dicta = new Docente_Dicta;
   
    
    $tabla = new Tabla();
    $alumno_cursa = new Alumno_Cursa();
    $materia_division = new Materia_Division();
    $division = new Division();
    $alumno = new Persona();
    $persona = new Persona();
    $relacion=$division;
	
	$divi_id=$division_id;
	$division=$division->buscar($divi_id);
	$materias=$division->materias();
	
	if($turno_id==2){
		$alus=$division->alumnosCursan($materia_id);
		if($alus)
		$personas=$persona->ordenarPersonas($alus);
	}else{
		$alus=$division->alumnosCursanAula();	
		if($alus)
		$personas=$persona->ordenarPersonas($alus);
	};
	
	if($materia_id){
	  $materia=$materia->buscar($materia_id);
	  $profesor= $division->docenteDicta($materia->id);
	}	

    $this->SetFont('Courier','',16);
    $this->Cell(0,16,'PLANILLA DE ASISTENCIAS',0,0,'C',1);
    $this->Ln();
    $this->SetFont('Courier','',10);
    if($persona->Sexo==1){
         $text_alum='Alumno';
         }else{
         $text_alum='Alumna';	
         } 
    $this->Cell(0,7,$this->nombre_corto(),0,0,'R',1);
    $this->Ln();
    if($turno_id==2){
    $this->Cell(40,7,'Docente',0,0,'L',1);
    $this->Cell(100,7,$profesor->nombre(),0,0,'L',1);
       $this->Ln();
       $this->Cell(40,7,'Asignatura',0,0,'L',1);
       $this->Cell(100,7,$materia->nombre,0,0,'L',1);
       $this->Ln();
       };
    $this->Cell(40,7,'Division',0,0,'L',1);
    $this->Cell(100,7,$division->leyendaT(),0,0,'L',1);
    $this->Ln();
    $this->Ln();
    $this->Cell(60,7,'ALUMNOS',1,0,'L',1);
    $this->Cell(25,7,$fecha_1,1,0,'L',1);
    $this->Cell(25,7,$fecha_2,1,0,'L',1);
    $this->Cell(25,7,$fecha_3,1,0,'L',1);
    $this->Cell(25,7,$fecha_4,1,0,'L',1);
    $this->Cell(25,7,$fecha_5,1,0,'L',1);
	$this->Ln();            	
    foreach($personas as $persona){
        $this->Cell(60,5,$persona->nombre(),1,0,'L',1);
	    $this->Cell(25,5,'',1,0,'L',1);
	    $this->Cell(25,5,'',1,0,'L',1);
	    $this->Cell(25,5,'',1,0,'L',1);
	    $this->Cell(25,5,'',1,0,'L',1);
	    $this->Cell(25,5,'',1,0,'L',1);
	    $this->Ln();            	
    };



}


function DocSancion($id){
    $this->AddPage("P");
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(02);
    $this->SetFont('');
	$legajo= new Legajo();
	$legajo=$legajo->buscarId($id);
	$persona= new Persona();
	$persona=$persona->buscarId($legajo->persona_id);
	$docente= new Persona();
	$docente=$persona->buscarId($legajo->persona_id1);
    $division=new Division();
    $legajo_docente=new Legajo_Docente();
    $legajo_materia=new Legajo_Materia();
    $division=$division->buscar($legajo->division_id);

    $this->SetFont('Courier','',16);
    $this->Cell(0,16,'PARTE DE SANCION DISCIPLINARIA',0,0,'C',1);
    $this->Ln();
    $this->SetFont('Courier','',10);
    if($persona->Sexo==1){
         $text_alum=' docente del alumno';
         }else{
         $text_alum=' docente de la alumna';	
         } 
    $TEXTO='El que suscribe '.$docente->nombre().$text_alum.' '.$persona->nombre().' que cursa el '.$division->leyendaT().'. Solicito se le aplique una sancion disciplinaria por '.$legajo->detalle_profesor;
    $this->Cell(0,7,$this->nombre_corto(),0,0,'R',1);
    $this->Ln();
    $this->Cell(0,7,'Villaguay (E.R.),'.date('j',time($legajo->fecha_alta)).' de '.strftime('%B',time($legajo->fecha_alta)).' de '.date('Y',time($legajo->fecha_alta)),0,0,'R',1);
    $this->Ln();
    $this->Cell(0,7,'Al señor Director del establecimiento, '.$persona->director($legajo->fecha_alta).'   (S/D)',0,0,'L',1);
    $this->Ln();
	$this->write(7,$TEXTO);
    $this->Ln();
    $this->Cell(0,7,'Saluda atte. ',0,0,'C',1);
    $this->Ln();
    $this->Ln();
    $this->Ln();
    $this->Ln();
    $this->Cell(0,7,' -----------------------------',0,0,'R',1);
    $this->Ln();
    $this->Cell(0,7,'Firma del Solicitante',0,0,'R',1);
    $this->Ln();
    $this->Ln();
    $this->Ln();
    $this->Cell(0,7,'DIRECCION',0,0,'L',1);
	$this->Ln();            	
    if($persona->Sexo==1){
         $text_alum='Alumno';
         }else{
         $text_alum='Alumna';	
         } 
    $TEXTO='        Atento a la falta cometida y de acuerdo a los antecedentes del alumno, apliquese al mismo la sancion disciplinaria de '.$legajo->amonestaciones.' amonestaciones';
    $this->write(6,$TEXTO);
    $this->Ln();
    $TEXTO='        Con la notificacion del padre, madre o tutor encargado del alumno. archivese en su legajo personal. ';
    $this->write(6,$TEXTO);
    $this->Ln();
    $this->Ln();
    $this->Ln();
    $this->Cell(0,6,' -----------------------------',0,0,'R',1);
    $this->Ln();
    $this->Cell(0,6,'Firma del Director            ',0,0,'R',1);
    $this->Ln();
    $this->Ln();
    $this->Ln();
    $TEXTO='        Se notifico a los encargados del alumno a los dias   ..../..../........ ';
    $this->write(6,$TEXTO);
    $this->Ln();
    $this->Ln();
    $this->Ln();
    $this->Cell(0,6,' -------------------------------',0,0,'R',1);
    $this->Ln();
    $this->Cell(0,6,'Firma del Responsable del alumno',0,0,'R',1);
    $this->Ln();


}



function DocSalfamiliar($id,$rela_tutor,$autoridades){
    $this->AddPage("P");
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(02);
    $this->SetFont('');
	$persona= new Persona();
	$persona=$persona->buscarId($id);
    $division=new Division();
    $division=$persona->buscarDivisionActual();
    $tutor=new Persona();
    $tutor=$persona->buscartutor($rela_tutor);

            
            $this->SetFont('Courier','',16);
	        $this->Cell(0,16,'CONSTANCIA DE SALARIO FAMILIAR',0,0,'C',1);
		    $this->Ln();
		    $this->Ln();
		    $this->SetFont('Courier','',10);
            if($rela_tutor==3){$varTUTOR='a cargo de';}else{$varTUTOR='hijo de';};
            $TEXTO='      CERTIFICO: que '.$persona->nombre().' D.N.I. Nº '.$persona->DNI.' '.$varTUTOR.' '.$tutor->nombre().' es alumno regular de '.$division->leyendaT().'.';
            $this->write(7,$TEXTO);
            $this->Ln();
            $TEXTO='A solicitud del interesado y para su presentación ante las autoridades de, '.$autoridades.'.';
            $this->write(7,$TEXTO);
  		    $this->Ln();
            $TEXTO='Firmo y sello la presente, a los '.date(j).' días del mes de '.strftime("%B").' de '.date(Y).'.';
		    $this->write(7,$TEXTO);
		    $this->Ln();
		    $this->Ln();
		    $this->Ln();
		    $this->Ln();
            $this->Cell(0,7,'................................................',0,0,'R',1);
		    $this->Ln();
            $this->Cell(0,7,'Sello y Firma                    ',0,0,'R',1);
}

function DocBoletoEstud($id,$transporte){
    $this->AddPage("P");
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(02);
    $this->SetFont('');
	$persona= new Persona();
	$persona=$persona->buscarId($id);
    $division=new Division();
    $division=$persona->buscarDivisionActual();


            $this->SetFont('Courier','',16);
	        $this->Cell(0,16,'CONSTANCIA DE BOLETO ESTUDIANTIL',0,0,'C',1);
		    $this->Ln();
		    $this->Ln();
            $this->SetFont('Courier','',10);
            if($persona->Sexo==1){$varNACIDO='nacido el';}else{$varNACIDO='nacida el';};
            $TEXTO='      CERTIFICO: que '.$persona->nombre().' '.$varNACIDO.' '.strtodatedmy($persona->fecha_nac).', cursa durante el año '.date("Y").' el '.$division->leyendaT().' en la Escuela Tecnológica Nº1 "Conrado Etchebarne".';
            $this->write(7,$TEXTO);
		    $this->Ln();
            $TEXTO='A solicitud del interesado y para su presentación ante las autoridades de la empresa de transporte de, '.$transporte.'.';
            $this->write(7,$TEXTO);
		    $TEXTO='Firmo y sello la presente, a los '.date(j).' días del mes de '.strftime("%B").' de '.date(Y).'.';
		    $this->Ln();
		    $this->write(7,$TEXTO);
		    $this->Ln();
		    $this->Ln();
		    $this->Ln();
            $this->Cell(0,7,'................................................',0,0,'R',1);
		    $this->Ln();
            $this->Cell(0,7,'Sello y Firma                    ',0,0,'R',1);
}


}
?>
