--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.14
-- Dumped by pg_dump version 9.6.5

-- Started on 2017-09-27 12:33:25 ART

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 11935)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2290 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 182 (class 1259 OID 64554)
-- Name: actividad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE actividad (
    denominacion character varying(200),
    participantes character varying,
    fecha_inicio date,
    fecha_fin date,
    observacion character varying,
    lugar character varying(50),
    id_actividad integer NOT NULL,
    departamento integer,
    tipo_actividad integer,
    institucion integer,
    nombre_corto character varying(20),
    nro_resolucion character varying(200)
);


ALTER TABLE actividad OWNER TO postgres;

--
-- TOC entry 2291 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN actividad.departamento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN actividad.departamento IS '
	';


--
-- TOC entry 188 (class 1259 OID 64776)
-- Name: actividad_id_actividad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE actividad_id_actividad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE actividad_id_actividad_seq OWNER TO postgres;

--
-- TOC entry 2292 (class 0 OID 0)
-- Dependencies: 188
-- Name: actividad_id_actividad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE actividad_id_actividad_seq OWNED BY actividad.id_actividad;


--
-- TOC entry 199 (class 1259 OID 74381)
-- Name: carrera; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE carrera (
    id_carrera integer NOT NULL,
    nombre character varying(100),
    id_plan integer,
    iniciales_siu character varying(10),
    ordenanza character varying(40),
    id_ua character varying(5)
);


ALTER TABLE carrera OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 74379)
-- Name: carreras_id_carrera_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE carreras_id_carrera_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE carreras_id_carrera_seq OWNER TO postgres;

--
-- TOC entry 2293 (class 0 OID 0)
-- Dependencies: 198
-- Name: carreras_id_carrera_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE carreras_id_carrera_seq OWNED BY carrera.id_carrera;


--
-- TOC entry 184 (class 1259 OID 64597)
-- Name: cobro; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE cobro (
    id_factura integer,
    monto_cobrado double precision,
    fecha_cobro date,
    id_rendicion integer,
    id_cobro integer NOT NULL
);


ALTER TABLE cobro OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 64793)
-- Name: cobro_id_cobro_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cobro_id_cobro_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cobro_id_cobro_seq OWNER TO postgres;

--
-- TOC entry 2294 (class 0 OID 0)
-- Dependencies: 190
-- Name: cobro_id_cobro_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cobro_id_cobro_seq OWNED BY cobro.id_cobro;


--
-- TOC entry 203 (class 1259 OID 74418)
-- Name: convenio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE convenio (
    id_convenio integer NOT NULL,
    sigla character varying(10),
    descripcion character varying(120)
);


ALTER TABLE convenio OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 74416)
-- Name: convenio_id_convenio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE convenio_id_convenio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE convenio_id_convenio_seq OWNER TO postgres;

--
-- TOC entry 2295 (class 0 OID 0)
-- Dependencies: 202
-- Name: convenio_id_convenio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE convenio_id_convenio_seq OWNED BY convenio.id_convenio;


--
-- TOC entry 207 (class 1259 OID 74432)
-- Name: cursa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE cursa (
    id integer NOT NULL,
    id_estudiante integer,
    id_carrera integer,
    materias_aprobadas integer
);


ALTER TABLE cursa OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 74430)
-- Name: cursa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cursa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cursa_id_seq OWNER TO postgres;

--
-- TOC entry 2296 (class 0 OID 0)
-- Dependencies: 206
-- Name: cursa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cursa_id_seq OWNED BY cursa.id;


--
-- TOC entry 178 (class 1259 OID 64513)
-- Name: estudiante; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE estudiante (
    id_estudiante integer NOT NULL,
    email character varying(50),
    telefono character varying(20),
    dni character varying(10),
    cuil character varying(12),
    nombre character varying(40),
    apellido character varying(30),
    legajo character varying(15),
    domicilio character varying(50)
);


ALTER TABLE estudiante OWNER TO postgres;

--
-- TOC entry 177 (class 1259 OID 64511)
-- Name: datos_pasante_id_pasante_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE datos_pasante_id_pasante_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE datos_pasante_id_pasante_seq OWNER TO postgres;

--
-- TOC entry 2297 (class 0 OID 0)
-- Dependencies: 177
-- Name: datos_pasante_id_pasante_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE datos_pasante_id_pasante_seq OWNED BY estudiante.id_estudiante;


--
-- TOC entry 175 (class 1259 OID 64501)
-- Name: departamento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE departamento (
    id_departamento integer NOT NULL,
    nombre character varying(100),
    id_ua character varying(5)
);


ALTER TABLE departamento OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 64750)
-- Name: departamento_id_departamento_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE departamento_id_departamento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE departamento_id_departamento_seq OWNER TO postgres;

--
-- TOC entry 2298 (class 0 OID 0)
-- Dependencies: 187
-- Name: departamento_id_departamento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE departamento_id_departamento_seq OWNED BY departamento.id_departamento;


--
-- TOC entry 179 (class 1259 OID 64537)
-- Name: docente_guia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE docente_guia (
    nombre character varying(50),
    apellido character varying(30),
    telefono character varying(20),
    id_docente integer NOT NULL,
    cuil character varying(12),
    id_sede integer
);


ALTER TABLE docente_guia OWNER TO postgres;

--
-- TOC entry 191 (class 1259 OID 64801)
-- Name: docente_guia_id_docente_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE docente_guia_id_docente_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE docente_guia_id_docente_seq OWNER TO postgres;

--
-- TOC entry 2299 (class 0 OID 0)
-- Dependencies: 191
-- Name: docente_guia_id_docente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE docente_guia_id_docente_seq OWNED BY docente_guia.id_docente;


--
-- TOC entry 183 (class 1259 OID 64574)
-- Name: facturacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE facturacion (
    nro_factura integer NOT NULL,
    fecha date,
    concepto character varying(40),
    monto double precision,
    dependencia integer,
    id_factura integer NOT NULL,
    institucion integer,
    id_actividad integer,
    id_sede integer
);


ALTER TABLE facturacion OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 64809)
-- Name: facturacion_id_factura_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE facturacion_id_factura_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE facturacion_id_factura_seq OWNER TO postgres;

--
-- TOC entry 2300 (class 0 OID 0)
-- Dependencies: 192
-- Name: facturacion_id_factura_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE facturacion_id_factura_seq OWNED BY facturacion.id_factura;


--
-- TOC entry 174 (class 1259 OID 64481)
-- Name: institucion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE institucion (
    cuil_cuit character varying(12),
    id_institucion integer NOT NULL,
    tipo integer,
    nombre character varying(200),
    direccion character varying,
    observacion character varying,
    telefono character varying(20),
    email character varying
);


ALTER TABLE institucion OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 64784)
-- Name: institucion_id_institucion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE institucion_id_institucion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE institucion_id_institucion_seq OWNER TO postgres;

--
-- TOC entry 2301 (class 0 OID 0)
-- Dependencies: 189
-- Name: institucion_id_institucion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE institucion_id_institucion_seq OWNED BY institucion.id_institucion;


--
-- TOC entry 200 (class 1259 OID 74385)
-- Name: localidad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE localidad (
    id_localidad integer NOT NULL,
    nombre character varying(40)
);


ALTER TABLE localidad OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 64548)
-- Name: pago_docente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pago_docente (
    nro_pago integer,
    id_docente integer,
    fecha_pago date,
    mes_pagado character varying(12),
    anio_pagado character(4),
    remuneracion double precision,
    comprobante integer,
    id_pago integer NOT NULL,
    nro_resolucion_decanal character varying(200)
);


ALTER TABLE pago_docente OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 73058)
-- Name: pago_docente_id_pago_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pago_docente_id_pago_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pago_docente_id_pago_seq OWNER TO postgres;

--
-- TOC entry 2302 (class 0 OID 0)
-- Dependencies: 197
-- Name: pago_docente_id_pago_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pago_docente_id_pago_seq OWNED BY pago_docente.id_pago;


--
-- TOC entry 181 (class 1259 OID 64551)
-- Name: pasantia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pasantia (
    id_estudiante integer,
    disciplina character varying(40),
    inicio_convenio date,
    fin_convenio date,
    horas_diarias integer,
    dias_semana integer,
    retribucion_mensual double precision,
    docente integer,
    estado integer,
    id_pasantia integer NOT NULL,
    id_actividad integer,
    id_convenio integer
);


ALTER TABLE pasantia OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 64817)
-- Name: pasante_id_pasante_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pasante_id_pasante_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pasante_id_pasante_seq OWNER TO postgres;

--
-- TOC entry 2303 (class 0 OID 0)
-- Dependencies: 193
-- Name: pasante_id_pasante_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pasante_id_pasante_seq OWNED BY pasantia.id_pasantia;


--
-- TOC entry 185 (class 1259 OID 64600)
-- Name: rendicion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE rendicion (
    nro_rendicion integer NOT NULL,
    fecha_rendicion date,
    id_rendicion integer NOT NULL
);


ALTER TABLE rendicion OWNER TO postgres;

--
-- TOC entry 194 (class 1259 OID 64825)
-- Name: rendicion_id_rendicion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE rendicion_id_rendicion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rendicion_id_rendicion_seq OWNER TO postgres;

--
-- TOC entry 2304 (class 0 OID 0)
-- Dependencies: 194
-- Name: rendicion_id_rendicion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rendicion_id_rendicion_seq OWNED BY rendicion.id_rendicion;


--
-- TOC entry 205 (class 1259 OID 74426)
-- Name: se_dicta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE se_dicta (
    id_dicta integer NOT NULL,
    id_sede integer,
    id_carrera integer
);


ALTER TABLE se_dicta OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 74424)
-- Name: se_dicta_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE se_dicta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE se_dicta_id_seq OWNER TO postgres;

--
-- TOC entry 2305 (class 0 OID 0)
-- Dependencies: 204
-- Name: se_dicta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE se_dicta_id_seq OWNED BY se_dicta.id_dicta;


--
-- TOC entry 201 (class 1259 OID 74411)
-- Name: sede; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE sede (
    id_sede integer NOT NULL,
    id_localidad integer,
    id_ua character varying(5)
);


ALTER TABLE sede OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 64506)
-- Name: tipo_actividad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipo_actividad (
    tipo character(30) NOT NULL,
    id_tipo_actividad integer NOT NULL
);


ALTER TABLE tipo_actividad OWNER TO postgres;

--
-- TOC entry 195 (class 1259 OID 64834)
-- Name: tipo_actividad_id_tipo_actividad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipo_actividad_id_tipo_actividad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tipo_actividad_id_tipo_actividad_seq OWNER TO postgres;

--
-- TOC entry 2306 (class 0 OID 0)
-- Dependencies: 195
-- Name: tipo_actividad_id_tipo_actividad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tipo_actividad_id_tipo_actividad_seq OWNED BY tipo_actividad.id_tipo_actividad;


--
-- TOC entry 173 (class 1259 OID 64478)
-- Name: tipo_institucion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipo_institucion (
    descripcion character varying(50) NOT NULL,
    id_tipo integer NOT NULL
);


ALTER TABLE tipo_institucion OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 64843)
-- Name: tipo_institucion_id_tipo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipo_institucion_id_tipo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tipo_institucion_id_tipo_seq OWNER TO postgres;

--
-- TOC entry 2307 (class 0 OID 0)
-- Dependencies: 196
-- Name: tipo_institucion_id_tipo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tipo_institucion_id_tipo_seq OWNED BY tipo_institucion.id_tipo;


--
-- TOC entry 186 (class 1259 OID 64615)
-- Name: unidad_academica; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE unidad_academica (
    sigla character varying(5) NOT NULL,
    nombre character varying(125)
);


ALTER TABLE unidad_academica OWNER TO postgres;

--
-- TOC entry 2071 (class 2604 OID 64778)
-- Name: actividad id_actividad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY actividad ALTER COLUMN id_actividad SET DEFAULT nextval('actividad_id_actividad_seq'::regclass);


--
-- TOC entry 2075 (class 2604 OID 74384)
-- Name: carrera id_carrera; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY carrera ALTER COLUMN id_carrera SET DEFAULT nextval('carreras_id_carrera_seq'::regclass);


--
-- TOC entry 2073 (class 2604 OID 64795)
-- Name: cobro id_cobro; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cobro ALTER COLUMN id_cobro SET DEFAULT nextval('cobro_id_cobro_seq'::regclass);


--
-- TOC entry 2076 (class 2604 OID 74421)
-- Name: convenio id_convenio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY convenio ALTER COLUMN id_convenio SET DEFAULT nextval('convenio_id_convenio_seq'::regclass);


--
-- TOC entry 2078 (class 2604 OID 74435)
-- Name: cursa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cursa ALTER COLUMN id SET DEFAULT nextval('cursa_id_seq'::regclass);


--
-- TOC entry 2065 (class 2604 OID 64752)
-- Name: departamento id_departamento; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY departamento ALTER COLUMN id_departamento SET DEFAULT nextval('departamento_id_departamento_seq'::regclass);


--
-- TOC entry 2068 (class 2604 OID 64803)
-- Name: docente_guia id_docente; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY docente_guia ALTER COLUMN id_docente SET DEFAULT nextval('docente_guia_id_docente_seq'::regclass);


--
-- TOC entry 2067 (class 2604 OID 64516)
-- Name: estudiante id_estudiante; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estudiante ALTER COLUMN id_estudiante SET DEFAULT nextval('datos_pasante_id_pasante_seq'::regclass);


--
-- TOC entry 2072 (class 2604 OID 64811)
-- Name: facturacion id_factura; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY facturacion ALTER COLUMN id_factura SET DEFAULT nextval('facturacion_id_factura_seq'::regclass);


--
-- TOC entry 2064 (class 2604 OID 64786)
-- Name: institucion id_institucion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY institucion ALTER COLUMN id_institucion SET DEFAULT nextval('institucion_id_institucion_seq'::regclass);


--
-- TOC entry 2069 (class 2604 OID 73060)
-- Name: pago_docente id_pago; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pago_docente ALTER COLUMN id_pago SET DEFAULT nextval('pago_docente_id_pago_seq'::regclass);


--
-- TOC entry 2070 (class 2604 OID 64819)
-- Name: pasantia id_pasantia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pasantia ALTER COLUMN id_pasantia SET DEFAULT nextval('pasante_id_pasante_seq'::regclass);


--
-- TOC entry 2074 (class 2604 OID 64827)
-- Name: rendicion id_rendicion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rendicion ALTER COLUMN id_rendicion SET DEFAULT nextval('rendicion_id_rendicion_seq'::regclass);


--
-- TOC entry 2077 (class 2604 OID 74429)
-- Name: se_dicta id_dicta; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY se_dicta ALTER COLUMN id_dicta SET DEFAULT nextval('se_dicta_id_seq'::regclass);


--
-- TOC entry 2066 (class 2604 OID 64836)
-- Name: tipo_actividad id_tipo_actividad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_actividad ALTER COLUMN id_tipo_actividad SET DEFAULT nextval('tipo_actividad_id_tipo_actividad_seq'::regclass);


--
-- TOC entry 2063 (class 2604 OID 64845)
-- Name: tipo_institucion id_tipo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_institucion ALTER COLUMN id_tipo SET DEFAULT nextval('tipo_institucion_id_tipo_seq'::regclass);


--
-- TOC entry 2257 (class 0 OID 64554)
-- Dependencies: 182
-- Data for Name: actividad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY actividad (denominacion, participantes, fecha_inicio, fecha_fin, observacion, lugar, id_actividad, departamento, tipo_actividad, institucion, nombre_corto, nro_resolucion) FROM stdin;
Pasantía YPF	\N	2017-07-07	2017-11-07	\N	\N	2	\N	1	29	\N	\N
Curso Marketing	Docente x	2017-09-26	2017-09-29	Capacitar al personal del establecimiento en las distintas estrategias para...	Centro de Empleados del Comercio de Nequen capital	3	\N	2	24	\N	\N
Capacitación del personal de YPF	\N	2017-10-04	2017-10-04	observación	Salón Azul	4	1	3	29	capacitacion YPF	\N
Nombre Completo Actividad	\N	2017-09-28	2017-09-29	\N	\N	5	1	3	24	Actividad1	\N
\.


--
-- TOC entry 2308 (class 0 OID 0)
-- Dependencies: 188
-- Name: actividad_id_actividad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('actividad_id_actividad_seq', 5, true);


--
-- TOC entry 2274 (class 0 OID 74381)
-- Dependencies: 199
-- Data for Name: carrera; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY carrera (id_carrera, nombre, id_plan, iniciales_siu, ordenanza, id_ua) FROM stdin;
595	LICENCIATURA EN CIENCIAS DE LA COMPUTACIÓN	233	LCOM	1112/13	FAIF
596	PROFESORADO EN INFORMÁTICA	235	PINFO	1185/13	FAIF
597	TECNICATURA UNIVERSITARIA EN DESARROLLO WEB	236	TSDAW	0312/09	FAIF
598	TECNICATURA UNIVERSITARIA EN ADMINISTRACIÓN DE SISTEMAS Y SOFTWARE LIBRE	238	TUASL	0895/12	FAIF
599	INGENIERÍA ELÉCTRICA	242	IELEC	807/97	FAIN
600	INGENIERÍA ELECTRÓNICA	243	IELTR	802/97	FAIN
601	INGENIERÍA MECÁNICA	244	IMECA	806/97	FAIN
602	INGENIERÍA CIVIL	245	INCIV	805/97	FAIN
603	INGENIERÍA QUÍMICA	246	INQUI	803/97	FAIN
604	INGENIERÍA EN PETRÓLEO	247	IPETR	804/97	FAIN
605	LICENCIATURA EN CIENCIAS GEOLÓGICAS	248	LCCG	443/09	FAIN
606	PROFESORADO EN FÍSICA	249	PRFCA	1002/98	FAIN
607	PROFESORADO EN NIVEL INICIAL	252	PENIN	886-1	FACE
608	LICENCIATURA EN CIENCIAS DE LA EDUCACION	255	LECED	139-434	FACE
609	PROFESORADO EN CIENCIAS DE LA EDUCACION	256	PECED	239-403	FACE
610	PROFESORADO EN COMUNICACION SOCIAL	262	PCSO	173	FADE
611	LICENCIATURA EN SOCIOLOGIA	265	LSOC	150	FADE
612	PROFESORADO EN INGLES	266	PIN09	430	FALE
613	PROFESORADO EN FILOSOFIA	268	PFILO	641	FAHU
614	PROFESORADO EN GEOGRAFIA	269	PGEO	573	FAHU
615	PROFESORADO EN HISTORIA	270	PHIST	96	FAHU
616	PROFESORADO EN LETRAS	271	PLETR	572	FAHU
617	LICENCIATURA EN TURISMO	272	LTUR	624/96	FATU
618	PROFESORADO EN QUIMICA	274	PRQCA	1001	FAIN
619	LICENCIATURA EN ENFERMERIA	276	LENF	0887/05	FAAS
620	TECNICATURA EN EMPRESAS DE SERVICIOS TURÍSTICOS	278	TEST	800/05	FATU
621	GUÍA UNIVERSITARIO EN TURISMO	279	GUT	1062/06	FATU
622	LICENCIATURA EN GERENCIAMIENTO GASTRONOMICO	282	LIGGA	0553/2011	FATA
623	PROFESORADO UNIVERSITARIO EN MATEMÁTICA	283	PUMAT	1467/14	FAEA
624	LICENCIATURA EN SISTEMAS DE INFORMACIÓN	285	LSI	1420/13	FAIF
625	LICENCIATURA EN ADMINISTRACION PUBLICA	286	LAPV	814/01	CUZA
626	LICENCIATURA EN CIENCIA POLITICA	287	LCPO	605/11	CUZA
627	LICENCIATURA EN GESTION DE EMPRESAS AGROPECUARIAS	290	LGAG	374/11	CUZA
628	PROFESORADO EN LENGUA Y COMUNICACION ORAL Y ESCRITA	291	PLEN	962/98	CUZA
629	LICENCIATURA EN PSICOPEDAGOGIA	292	LPSV	432/09	CUZA
630	PROFESORADO EN PSICOPEDAGOGIA	293	PPSV	431/09	CUZA
631	PROFESORADO EN CIENCIAS AGROPECUARIAS	295	PCAGR	995/12	CUZA
632	TECNICATURA UNIVERSITARIA EN ADMINISTRACION PUBLICA	296	TUAP	1521/13	CUZA
633	PROFESORADO EN CIENCIAS ECONÓMICAS	298	PCSE	999/2002	FAEA
634	LICENCIATURA EN MATEMÁTICA	300	LMAT	0187/98	FAEA
635	CONTADOR PÚBLICO NACIONAL	301	CDOR	088/85	FAEA
636	LICENCIATURA EN ADMINISTRACIÓN	302	LADM	1033/05	FAEA
637	CICLO GENERAL EN CIENCIAS ECONÓMICAS	303	CGCE	0212/98	FAEA
638	PSICOLOGIA	307	PSICO	153-14	FACE
639	TECNICATURA EN PLANTAS Y ANÁLISIS DE MENAS	390			AUZA
640	LICENCIATURA EN TECNOLOGÍA MINERA	391	LTMI	232/91, Mod. 912/01 y 216/09	AUZA
641	TÉCNICO UNIVERSITARIO FORESTAL	393	TFOR	390	ASMA
642	TECNICATURA UNIVERSITARIA EN ESPACIOS VERDES	394	TUEV	442	ASMA
643	PROFESORADO EN CIENCIAS BIOLÓGICAS	397			CRUB
644	LICENCIATURA EN CIENCIAS BIOLÓGICAS	398			CRUB
645	TÉCNICO UNIVERSITARIO EN ACUICULTURA	399			CRUB
646	PROFESORADO EN EDUCACIÓN FÍSICA	400			CRUB
647	MEDICINA	403	MEDI	1047/13	FAME
648	LICENCIATURA EN BIOLOGÍA MARINA	404	LBIOM	0062/08	ESCM
649	LICENCIATURA EN HISTORIA	411			CRUB
650	TECNICATURA EN PRODUCCIÓN PESQUERA Y MARICULTURA	414	TPPM	00298	ESCM
651	TRADUCTORADO PÚBLICO EN IDIOMA INGLÉS	417			FALE
652	LICENCIATURA EN FILOSOFÍA	418	LFILO	641	FAHU
653	LICENCIATURA EN GEOGRAFÍA	419	LGEOG	573	FAHU
654	INGENIERIA AGRONOMICA	420	IAGR	0031	FACA
655	LICENCIATURA EN HISTORIA	421	LHIST	96	FAHU
656	LICENCIATURA EN LETRAS	422	LLETR	572	FAHU
657	LICENCIATURA EN TECNOLOGIA DE LOS ALIMENTOS	423	LITA	238	FATA
658	TECNICATURA EN CONTROL E HIGIENE DE LOS ALIMENTOS	425	TCHA	0550	FATA
659	TECNICATURA EN PLANIFICACION AMBIENTAL	426	TPLAN	500	FAHU
660	LICENCIATURA EN HIGIENE Y SEGURIDAD EN EL TRABAJO (4TO Y 5TO CICLO)	432	.		FAAS
661	LICENCIATURA EN SANEAMIENTO Y PROTECCIÓN AMBIENTAL	433			FAAS
662	ABOGACÍA	434	ABOG		FADE
663	PROFESORADO UNIVERSITARIO EN CIENCIA POLÍTICA	435			CUZA
664	TECNICATURA SUPERIOR EN PRODUCCIÓN AGROPECUARIA	436			CUZA
665	LICENCIATURA EN GESTIÓN DE RECURSOS HUMANOS	438	LRH		CUZA
666	LICENCIATURA EN COMUNICACIÓN SOCIAL	441	LCSO		FADE
667	LICENCIATURA EN SERVICIO SOCIAL	443	LSS		FADE
668	DOCTORADO EN ENSEñANZA DE CIENCIAS EXACTAS Y NATURALES	446	002	078/2010	FAIN
669	MAESTRíA EN LINGüíSTICA APLICADA	447	ML	POSGRADO	FALE
670	LA MAESTRíA EN LINGüíSTICA APLICADA CON ORIENTACIóN ENSEñANZA DE LENGUAS EXTRANJERAS	448	MLA	POSGRADO	FALE
671	DOCTORADO EN EDUCACIóN	450	DOE	438/2009	FACE
672	ESPECIALIZACIóN EN DIDáCTICA DE LAS CS. SOCIALES, CON MENCIóN EN HISTORIA, GEOGRAFíA Y EDUCACIóN	451	EDCS	639/2012	FACE
673	MAESTRíA EN LINGüíSTICA	452	ML956	0956/93	FALE
674	MAESTRíA EN LINGüíSTICA APLICADA A LA ENSEñANZA DE LAS LENGUAS EXTRANJERAS	453	EL787	789/2012	FALE
675	ESPECIALIZACIóN EN LINGüíSTICA APLICADA CON ORIENTACIóN ENSEñANZA DE LENGUAS EXTRANJERAS	454	MLA01	787/2012	FALE
676	ESPECIALIZACIóN EN DERECHO ADMINISTRATIVO	455	EDADM	394/2003	FADE
677	MAESTRÍA EN SOCIOLOGÍA DE LA AGRICULTURA LATINOAMERICANA	456	MASAL	131/1998	FADE
678	DOCTORADO EN HISTORIA	457	DH	206/2015	FAHU
679	MAESTRíA EN ESTUDIOS DE LAS MUJERES Y DE GéNERO	458	MEG	144/2014	FAHU
680	MAESTRíA EN ECONOMíA Y POLíTICA ENERGéTICO AMBIENTAL	459	MEPEA	220/1998	FAEA
681	ESPECIALIZACIóN EN TRIBUTACIóN.	460	TRIBU	760/97	FAEA
682	ESPECIALIZACIóN EN MARKETING DE SERVICIOS	461	ESMAR	303/2011	FATU
683	MAESTRíA EN MARKETING DE SERVICIOS	462	MMS	705/2010	FATU
685	ESPECIALIZACIóN EN TRABAJO SOCIAL FORENSE	464	ETSFO	104/2010	FADE
686	DOCTORADO EN BIOLOGíA	465	DB	556/1986	CRUB
687	MAESTRíA EN INTERVENCIóN AMBIENTAL	466	MIA	794/2005	FAIN
688	ESPECIALIZACIóN EN HIGIENE, SEGURIDAD Y MEDIO AMBIENTE EN LA CONSTRUCCIóN.	467	001	1170/2006	FAIN
689	DOCTORADO EN INGENIERíA	468	DING	1049/2013	FAIN
690	ESPECIALIZACIóN EN CALIDAD E INOCUIDAD DE ALIMENTOS	469	ECIA	698/2010	FATA
691	ESPECIALIZACIóN EN FRUTOS SECOS	470	EFSV	1442/2014	CUZA
692	MAESTRíA EN GESTIóN EMPRESARIA	471	MAGE	794/2012	FAEA
693	ESPECIALIZACIóN EN CALIDAD DE AGUAS SUPERFICIALES	472	ECAS	467/2009	FATA
684	ESPECIALIZACIÓN EN TRABAJO SOCIAL FORENSE	463	ETSF	104/2010	FADE
\.


--
-- TOC entry 2309 (class 0 OID 0)
-- Dependencies: 198
-- Name: carreras_id_carrera_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('carreras_id_carrera_seq', 693, true);


--
-- TOC entry 2259 (class 0 OID 64597)
-- Dependencies: 184
-- Data for Name: cobro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cobro (id_factura, monto_cobrado, fecha_cobro, id_rendicion, id_cobro) FROM stdin;
\.


--
-- TOC entry 2310 (class 0 OID 0)
-- Dependencies: 190
-- Name: cobro_id_cobro_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cobro_id_cobro_seq', 1, false);


--
-- TOC entry 2278 (class 0 OID 74418)
-- Dependencies: 203
-- Data for Name: convenio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY convenio (id_convenio, sigla, descripcion) FROM stdin;
\.


--
-- TOC entry 2311 (class 0 OID 0)
-- Dependencies: 202
-- Name: convenio_id_convenio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('convenio_id_convenio_seq', 1, false);


--
-- TOC entry 2282 (class 0 OID 74432)
-- Dependencies: 207
-- Data for Name: cursa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cursa (id, id_estudiante, id_carrera, materias_aprobadas) FROM stdin;
\.


--
-- TOC entry 2312 (class 0 OID 0)
-- Dependencies: 206
-- Name: cursa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cursa_id_seq', 1, false);


--
-- TOC entry 2313 (class 0 OID 0)
-- Dependencies: 177
-- Name: datos_pasante_id_pasante_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('datos_pasante_id_pasante_seq', 1, true);


--
-- TOC entry 2250 (class 0 OID 64501)
-- Dependencies: 175
-- Data for Name: departamento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY departamento (id_departamento, nombre, id_ua) FROM stdin;
1	Contaduría	FAEA
\.


--
-- TOC entry 2314 (class 0 OID 0)
-- Dependencies: 187
-- Name: departamento_id_departamento_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('departamento_id_departamento_seq', 1, false);


--
-- TOC entry 2254 (class 0 OID 64537)
-- Dependencies: 179
-- Data for Name: docente_guia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY docente_guia (nombre, apellido, telefono, id_docente, cuil, id_sede) FROM stdin;
\.


--
-- TOC entry 2315 (class 0 OID 0)
-- Dependencies: 191
-- Name: docente_guia_id_docente_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('docente_guia_id_docente_seq', 1, false);


--
-- TOC entry 2253 (class 0 OID 64513)
-- Dependencies: 178
-- Data for Name: estudiante; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY estudiante (id_estudiante, email, telefono, dni, cuil, nombre, apellido, legajo, domicilio) FROM stdin;
1	eail@gmail.com	15476879	356473688	\N	Pasante1	Apellido	faea29893	\N
\.


--
-- TOC entry 2258 (class 0 OID 64574)
-- Dependencies: 183
-- Data for Name: facturacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY facturacion (nro_factura, fecha, concepto, monto, dependencia, id_factura, institucion, id_actividad, id_sede) FROM stdin;
\.


--
-- TOC entry 2316 (class 0 OID 0)
-- Dependencies: 192
-- Name: facturacion_id_factura_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('facturacion_id_factura_seq', 1, false);


--
-- TOC entry 2249 (class 0 OID 64481)
-- Dependencies: 174
-- Data for Name: institucion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY institucion (cuil_cuit, id_institucion, tipo, nombre, direccion, observacion, telefono, email) FROM stdin;
74880708307	26	2	Institucion ejemplo	dirección vacía	obaservación vacia	\N	\N
32379492799	16	3	Institucion ejemplo2	direccion jemplo 2	contacto de persona ejemplo 2	\N	\N
37299888881	28	1	Persona3	direccion casa	observacion de persona 3	\N	\N
34934838409	29	3	YPF	talero	observacion sobre contacto en YPF	\N	\N
33508358259	24	3	Cervecería Quilmes	Alberdi 88	\N	(0299)  155 446578	quilmes-nqn@dfnvvfv.com
11111111111	32	1	Ejemplo abm1	dir	obs	tel	email@gmail.com
22222222222	33	3	Ejemplo abm2	\N	\N	\N	\N
32334252422	34	2	Nueva Persona Jurídica	direccion persona	obs persona	(0299) 4487785	personajuridica@persona.com
11111111113	30	1	Ejemplo abm1	dir	obs	tel	email
11111111112	31	1	Ejemplo abm1	dir	obs	tel	email@gmail.com
\.


--
-- TOC entry 2317 (class 0 OID 0)
-- Dependencies: 189
-- Name: institucion_id_institucion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('institucion_id_institucion_seq', 34, true);


--
-- TOC entry 2275 (class 0 OID 74385)
-- Dependencies: 200
-- Data for Name: localidad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY localidad (id_localidad, nombre) FROM stdin;
1	Cinco Saltos
2	Cipolletti
3	General Roca
4	Neuquén Capital
5	San Carlos de Bariloche
6	Viedma
7	San Antonio Oeste
8	San Martín de los Andes
9	Zapala
10	Villa Regina
11	Allen
13	Esquel
12	Choele Choel
14	Trelew
15	Puerto Madryn
16	Chos Malal
\.


--
-- TOC entry 2255 (class 0 OID 64548)
-- Dependencies: 180
-- Data for Name: pago_docente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pago_docente (nro_pago, id_docente, fecha_pago, mes_pagado, anio_pagado, remuneracion, comprobante, id_pago, nro_resolucion_decanal) FROM stdin;
\.


--
-- TOC entry 2318 (class 0 OID 0)
-- Dependencies: 197
-- Name: pago_docente_id_pago_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pago_docente_id_pago_seq', 1, false);


--
-- TOC entry 2319 (class 0 OID 0)
-- Dependencies: 193
-- Name: pasante_id_pasante_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pasante_id_pasante_seq', 1, false);


--
-- TOC entry 2256 (class 0 OID 64551)
-- Dependencies: 181
-- Data for Name: pasantia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pasantia (id_estudiante, disciplina, inicio_convenio, fin_convenio, horas_diarias, dias_semana, retribucion_mensual, docente, estado, id_pasantia, id_actividad, id_convenio) FROM stdin;
\.


--
-- TOC entry 2260 (class 0 OID 64600)
-- Dependencies: 185
-- Data for Name: rendicion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rendicion (nro_rendicion, fecha_rendicion, id_rendicion) FROM stdin;
\.


--
-- TOC entry 2320 (class 0 OID 0)
-- Dependencies: 194
-- Name: rendicion_id_rendicion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rendicion_id_rendicion_seq', 1, false);


--
-- TOC entry 2280 (class 0 OID 74426)
-- Dependencies: 205
-- Data for Name: se_dicta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY se_dicta (id_dicta, id_sede, id_carrera) FROM stdin;
\.


--
-- TOC entry 2321 (class 0 OID 0)
-- Dependencies: 204
-- Name: se_dicta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('se_dicta_id_seq', 1, false);


--
-- TOC entry 2276 (class 0 OID 74411)
-- Dependencies: 201
-- Data for Name: sede; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sede (id_sede, id_localidad, id_ua) FROM stdin;
20	11	FAAS
21	12	FAAS
2	8	ASMA
1	9	AUZA
4	5	CRUB
18	6	CUZA
6	7	ESCM
24	1	FACA
13	2	FACE
12	4	FAAS
5	2	FAME
16	10	FATA
17	3	FADE
140	4	FADE
14	4	FAEA
15	4	FAHU
3	4	FAIF
19	4	FAIN
11	4	FATU
10	3	FALE
141	16	FAIN
\.


--
-- TOC entry 2251 (class 0 OID 64506)
-- Dependencies: 176
-- Data for Name: tipo_actividad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipo_actividad (tipo, id_tipo_actividad) FROM stdin;
Pasantía                      	1
Curso                         	2
Capacitación                  	3
Asistencia Técnica            	4
Evento                        	5
Otro                          	6
\.


--
-- TOC entry 2322 (class 0 OID 0)
-- Dependencies: 195
-- Name: tipo_actividad_id_tipo_actividad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipo_actividad_id_tipo_actividad_seq', 1, false);


--
-- TOC entry 2248 (class 0 OID 64478)
-- Dependencies: 173
-- Data for Name: tipo_institucion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipo_institucion (descripcion, id_tipo) FROM stdin;
Persona Fisica	1
Persona Juridica Privada	3
Persona Juridica Publica	2
\.


--
-- TOC entry 2323 (class 0 OID 0)
-- Dependencies: 196
-- Name: tipo_institucion_id_tipo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipo_institucion_id_tipo_seq', 3, true);


--
-- TOC entry 2261 (class 0 OID 64615)
-- Dependencies: 186
-- Data for Name: unidad_academica; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY unidad_academica (sigla, nombre) FROM stdin;
ASMA	Asentamiento Universitario San Martín de los Andes
FAIN	Facultad de Ingeniería
FADE	Facultad de Derecho y Ciencias Sociales
FATU	Facultad de Turismo
FALE	Facultad de Lenguas
AUZA	Asentamiento Universitario Zapala
CRUB	Centro Regional Universitario Bariloche
CUZA	Centro Universitario Regional Zona Atlántica
ESCM	Escuela Superior de Ciencias Marinas
FACA	Facultad de Ciencias Agrarias
FACE	Facultad de Ciencias de la Educación
FAAS	Facultad de Ciencias del Ambiente y la Salud
FAME	Facultad de Ciencias Médicas
FATA	Facultad de Ciencias y Tecnologías de los Alimentos
FAEA	Facultad de Economía y Administración
FAHU	Facultad de Humanidades
FAIF	Facultad de Informática
\.


--
-- TOC entry 2116 (class 2606 OID 90866)
-- Name: cursa pk_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cursa
    ADD CONSTRAINT pk_id PRIMARY KEY (id);


--
-- TOC entry 2096 (class 2606 OID 64783)
-- Name: actividad pk_id_actividad; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY actividad
    ADD CONSTRAINT pk_id_actividad PRIMARY KEY (id_actividad);


--
-- TOC entry 2106 (class 2606 OID 90810)
-- Name: carrera pk_id_carrera; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY carrera
    ADD CONSTRAINT pk_id_carrera PRIMARY KEY (id_carrera);


--
-- TOC entry 2100 (class 2606 OID 64800)
-- Name: cobro pk_id_cobro; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cobro
    ADD CONSTRAINT pk_id_cobro PRIMARY KEY (id_cobro);


--
-- TOC entry 2112 (class 2606 OID 74423)
-- Name: convenio pk_id_convenio; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY convenio
    ADD CONSTRAINT pk_id_convenio PRIMARY KEY (id_convenio);


--
-- TOC entry 2084 (class 2606 OID 64757)
-- Name: departamento pk_id_departamento; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY departamento
    ADD CONSTRAINT pk_id_departamento PRIMARY KEY (id_departamento);


--
-- TOC entry 2114 (class 2606 OID 90902)
-- Name: se_dicta pk_id_dicta; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY se_dicta
    ADD CONSTRAINT pk_id_dicta PRIMARY KEY (id_dicta);


--
-- TOC entry 2090 (class 2606 OID 64808)
-- Name: docente_guia pk_id_docente; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY docente_guia
    ADD CONSTRAINT pk_id_docente PRIMARY KEY (id_docente);


--
-- TOC entry 2088 (class 2606 OID 90864)
-- Name: estudiante pk_id_estudiante; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT pk_id_estudiante PRIMARY KEY (id_estudiante);


--
-- TOC entry 2098 (class 2606 OID 64816)
-- Name: facturacion pk_id_factura; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY facturacion
    ADD CONSTRAINT pk_id_factura PRIMARY KEY (id_factura);


--
-- TOC entry 2082 (class 2606 OID 64791)
-- Name: institucion pk_id_institucion; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY institucion
    ADD CONSTRAINT pk_id_institucion PRIMARY KEY (id_institucion);


--
-- TOC entry 2108 (class 2606 OID 74392)
-- Name: localidad pk_id_localidad; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY localidad
    ADD CONSTRAINT pk_id_localidad PRIMARY KEY (id_localidad);


--
-- TOC entry 2092 (class 2606 OID 73065)
-- Name: pago_docente pk_id_pago; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pago_docente
    ADD CONSTRAINT pk_id_pago PRIMARY KEY (id_pago);


--
-- TOC entry 2094 (class 2606 OID 64824)
-- Name: pasantia pk_id_pasantia; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pasantia
    ADD CONSTRAINT pk_id_pasantia PRIMARY KEY (id_pasantia);


--
-- TOC entry 2102 (class 2606 OID 64833)
-- Name: rendicion pk_id_rendicion; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rendicion
    ADD CONSTRAINT pk_id_rendicion PRIMARY KEY (id_rendicion);


--
-- TOC entry 2110 (class 2606 OID 74415)
-- Name: sede pk_id_sede; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sede
    ADD CONSTRAINT pk_id_sede PRIMARY KEY (id_sede);


--
-- TOC entry 2080 (class 2606 OID 64850)
-- Name: tipo_institucion pk_id_tipo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_institucion
    ADD CONSTRAINT pk_id_tipo PRIMARY KEY (id_tipo);


--
-- TOC entry 2086 (class 2606 OID 64842)
-- Name: tipo_actividad pk_id_tipo_actividad; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_actividad
    ADD CONSTRAINT pk_id_tipo_actividad PRIMARY KEY (id_tipo_actividad);


--
-- TOC entry 2104 (class 2606 OID 74405)
-- Name: unidad_academica pk_sigla; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY unidad_academica
    ADD CONSTRAINT pk_sigla PRIMARY KEY (sigla);


--
-- TOC entry 2125 (class 2606 OID 64868)
-- Name: actividad fk_actividad_departamento; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY actividad
    ADD CONSTRAINT fk_actividad_departamento FOREIGN KEY (departamento) REFERENCES departamento(id_departamento);


--
-- TOC entry 2127 (class 2606 OID 64888)
-- Name: actividad fk_actividad_institucion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY actividad
    ADD CONSTRAINT fk_actividad_institucion FOREIGN KEY (institucion) REFERENCES institucion(id_institucion);


--
-- TOC entry 2126 (class 2606 OID 64873)
-- Name: actividad fk_actividad_tipo_actividad; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY actividad
    ADD CONSTRAINT fk_actividad_tipo_actividad FOREIGN KEY (tipo_actividad) REFERENCES tipo_actividad(id_tipo_actividad);


--
-- TOC entry 2132 (class 2606 OID 90953)
-- Name: carrera fk_carrera_unidad_academica; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY carrera
    ADD CONSTRAINT fk_carrera_unidad_academica FOREIGN KEY (id_ua) REFERENCES unidad_academica(sigla);


--
-- TOC entry 2131 (class 2606 OID 64883)
-- Name: cobro fk_cobro_facturacion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cobro
    ADD CONSTRAINT fk_cobro_facturacion FOREIGN KEY (id_factura) REFERENCES facturacion(id_factura);


--
-- TOC entry 2130 (class 2606 OID 64878)
-- Name: cobro fk_cobro_rendicion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cobro
    ADD CONSTRAINT fk_cobro_rendicion FOREIGN KEY (id_rendicion) REFERENCES rendicion(id_rendicion);


--
-- TOC entry 2137 (class 2606 OID 90867)
-- Name: cursa fk_cursa_carrera; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cursa
    ADD CONSTRAINT fk_cursa_carrera FOREIGN KEY (id_carrera) REFERENCES carrera(id_carrera);


--
-- TOC entry 2138 (class 2606 OID 90872)
-- Name: cursa fk_cursa_estudiante; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cursa
    ADD CONSTRAINT fk_cursa_estudiante FOREIGN KEY (id_estudiante) REFERENCES estudiante(id_estudiante);


--
-- TOC entry 2118 (class 2606 OID 90831)
-- Name: departamento fk_departamento_unidad_academica; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY departamento
    ADD CONSTRAINT fk_departamento_unidad_academica FOREIGN KEY (id_ua) REFERENCES unidad_academica(sigla);


--
-- TOC entry 2119 (class 2606 OID 90877)
-- Name: docente_guia fk_docente_guia_sede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY docente_guia
    ADD CONSTRAINT fk_docente_guia_sede FOREIGN KEY (id_sede) REFERENCES sede(id_sede);


--
-- TOC entry 2128 (class 2606 OID 64893)
-- Name: facturacion fk_facturacion_actividad; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY facturacion
    ADD CONSTRAINT fk_facturacion_actividad FOREIGN KEY (id_actividad) REFERENCES actividad(id_actividad);


--
-- TOC entry 2129 (class 2606 OID 90882)
-- Name: facturacion fk_facturacion_sede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY facturacion
    ADD CONSTRAINT fk_facturacion_sede FOREIGN KEY (id_sede) REFERENCES sede(id_sede);


--
-- TOC entry 2117 (class 2606 OID 64898)
-- Name: institucion fk_institucion_tipo_institucion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY institucion
    ADD CONSTRAINT fk_institucion_tipo_institucion FOREIGN KEY (tipo) REFERENCES tipo_institucion(id_tipo);


--
-- TOC entry 2120 (class 2606 OID 73066)
-- Name: pago_docente fk_pago_docente_docente_guia; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pago_docente
    ADD CONSTRAINT fk_pago_docente_docente_guia FOREIGN KEY (id_docente) REFERENCES docente_guia(id_docente);


--
-- TOC entry 2121 (class 2606 OID 64903)
-- Name: pasantia fk_pasantia_actividad; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pasantia
    ADD CONSTRAINT fk_pasantia_actividad FOREIGN KEY (id_actividad) REFERENCES actividad(id_actividad);


--
-- TOC entry 2122 (class 2606 OID 73048)
-- Name: pasantia fk_pasantia_docente_guia; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pasantia
    ADD CONSTRAINT fk_pasantia_docente_guia FOREIGN KEY (docente) REFERENCES docente_guia(id_docente);


--
-- TOC entry 2123 (class 2606 OID 90891)
-- Name: pasantia fk_pasatia_convenio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pasantia
    ADD CONSTRAINT fk_pasatia_convenio FOREIGN KEY (id_convenio) REFERENCES convenio(id_convenio);


--
-- TOC entry 2124 (class 2606 OID 90896)
-- Name: pasantia fk_pasatia_estudiante; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pasantia
    ADD CONSTRAINT fk_pasatia_estudiante FOREIGN KEY (id_estudiante) REFERENCES estudiante(id_estudiante);


--
-- TOC entry 2136 (class 2606 OID 90908)
-- Name: se_dicta fk_se_dicta_carrera; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY se_dicta
    ADD CONSTRAINT fk_se_dicta_carrera FOREIGN KEY (id_carrera) REFERENCES carrera(id_carrera);


--
-- TOC entry 2135 (class 2606 OID 90903)
-- Name: se_dicta fk_se_dicta_sede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY se_dicta
    ADD CONSTRAINT fk_se_dicta_sede FOREIGN KEY (id_sede) REFERENCES sede(id_sede);


--
-- TOC entry 2134 (class 2606 OID 90918)
-- Name: sede fk_sede_localidad; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sede
    ADD CONSTRAINT fk_sede_localidad FOREIGN KEY (id_localidad) REFERENCES localidad(id_localidad);


--
-- TOC entry 2133 (class 2606 OID 90913)
-- Name: sede fk_sede_unidad_academica; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sede
    ADD CONSTRAINT fk_sede_unidad_academica FOREIGN KEY (id_ua) REFERENCES unidad_academica(sigla);


--
-- TOC entry 2289 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2017-09-27 12:33:25 ART

--
-- PostgreSQL database dump complete
--

