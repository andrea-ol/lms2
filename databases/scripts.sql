CREATE TABLE public.mdl_block_califica (
	id bigserial NOT NULL,
	userid int8 NULL,
	enrolid int8 NULL,
	reaprendizaje text NULL,
	descripcionra text NULL,
	courseid int8 NULL,
	fullname varchar(254) NULL,
	categoryid int8 NULL,
	cpr_nombre_competencia text NULL,
	rea_id int8 NULL,
	rea_nombre text NULL,
	rea_estado int8 NULL,
	CONSTRAINT mdl_bloccali_id_pk PRIMARY KEY (id)
);
CREATE INDEX mdl_bloccali_cat_ix ON public.mdl_block_califica USING btree (categoryid);
CREATE INDEX mdl_bloccali_cou_ix ON public.mdl_block_califica USING btree (courseid);
CREATE INDEX mdl_bloccali_enr_ix ON public.mdl_block_califica USING btree (enrolid);
CREATE INDEX mdl_bloccali_ful_ix ON public.mdl_block_califica USING btree (fullname);
CREATE INDEX mdl_bloccali_use_ix ON public.mdl_block_califica USING btree (userid);



INSERT INTO public.mdl_block_califica (userid,enrolid,reaprendizaje,descripcionra,courseid,fullname,categoryid,cpr_nombre_competencia,rea_id,rea_nombre,rea_estado) VALUES
	 (80,1,'D','Descripción para D',2,'OTRO CURSO (1234567 ABC123)',2,'2',2,'OPERACION DE HERRAMIENTAS INFORMATICAS',1),
	 (81,1,'D','Descripción para D',2,'OTRO CURSO (1234567 ABC123)',2,'2',2,'OPERACION DE HERRAMIENTAS INFORMATICAS',1),
	 (82,1,'D','Descripción para D',2,'OTRO CURSO (1234567 ABC123)',2,'2',2,'OPERACION DE HERRAMIENTAS INFORMATICAS',1),
	 (83,1,'D','Descripción para D',2,'OTRO CURSO (1234567 ABC123)',2,'2',2,'OPERACION DE HERRAMIENTAS INFORMATICAS',1),
	 (84,1,'D','Descripción para D',2,'OTRO CURSO (1234567 ABC123)',2,'2',2,'OPERACION DE HERRAMIENTAS INFORMATICAS',1),
	 (85,1,'A','Descripción para A',2,'OTRO CURSO (1234567 ABC123)',2,'3',3,'OPERACION DE HERRAMIENTAS INFORMATICAS',1),
	 (86,1,'A','Descripción para A',2,'OTRO CURSO (1234567 ABC123)',2,'3',3,'OPERACION DE HERRAMIENTAS INFORMATICAS',1),
	 (87,1,'A','Descripción para A',2,'OTRO CURSO (1234567 ABC123)',2,'3',3,'OPERACION DE HERRAMIENTAS INFORMATICAS',1),
	 (88,1,'A','Descripción para A',2,'OTRO CURSO (1234567 ABC123)',2,'3',3,'OPERACION DE HERRAMIENTAS INFORMATICAS',1),
	 (89,1,'A','Descripción para A',2,'OTRO CURSO (1234567 ABC123)',2,'3',3,'OPERACION DE HERRAMIENTAS INFORMATICAS',1);
INSERT INTO public.mdl_block_califica (userid,enrolid,reaprendizaje,descripcionra,courseid,fullname,categoryid,cpr_nombre_competencia,rea_id,rea_nombre,rea_estado) VALUES
	 (90,1,'A','Descripción para A',2,'OTRO CURSO (1234567 ABC123)',2,'3',3,'OPERACION DE HERRAMIENTAS INFORMATICAS',1);



