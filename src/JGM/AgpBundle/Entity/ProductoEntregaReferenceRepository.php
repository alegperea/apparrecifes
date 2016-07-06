<?php

namespace JGM\AgpBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UsuarioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductoEntregaReferenceRepository extends EntityRepository {

    public function findByProductoEntrega($id_producto, $id_entrega) {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select('per')
                ->from('AgpBundle:ProductoEntregaReference', 'per')
                ->where("per.producto = :id_producto")
                ->andWhere("per.entrega = :id_entrega")
                ->setParameter("id_producto", $id_producto)
                ->setParameter("id_entrega", $id_entrega);
        
        return $query->getQuery()->getResult();
    }

    public function findByEliminado($eliminado) {
        return $this->getEntityManager()
                        ->createQuery("SELECT e 
                    FROM UsuarioBundle:Usuario e 
                    WHERE e.eliminado = :eliminado")
                        ->setParameter('eliminado', $eliminado)
                        ->getResult();
    }

    public function findByActivos() {
        return $this->getEntityManager()
                        ->createQuery("SELECT e 
                    FROM UsuarioBundle:Usuario e 
                    WHERE e.eliminado = :eliminado")
                        ->setParameter('eliminado', false)
                        ->getResult();
    }

    public function findOneByNombreApellido($nombreApellido) {
        list($nombre, $apellido) = explode(" ", $nombreApellido);
        $consulta = $this->getEntityManager()
                ->createQuery('SELECT u 
                FROM UsuarioBundle:Usuario u
                WHERE u.nombre = :nombre
                AND u.apellido = :apellido
                AND u.eliminado = false')
                ->setParameters(array(
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                ))
                ->setMaxResults(1)
        ;
        try {
            return $consulta->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
        ;
    }

    public function findPaginasInicio($paginas_inicio) {
        return $this->getEntityManager()
                        ->createQuery("SELECT p
                    FROM UsuarioBundle:PaginaInicio p
                    WHERE p.nombre in $paginas_inicio")
                        ->getResult()
        ;
    }

    public function updUsuariosBloquados($fecha) {
        $consulta = $this->getEntityManager()
                ->createQueryBuilder()
                ->update('UsuarioBundle:Usuario', 'e')
                ->set('e.estado', \JGM\CoreBundle\Entity\EstadoEncargado::OFFLINE)
                ->where('e.estado = :estado')
                ->andWhere('e.fechaActualizacionServer < :fecha')
                ->setParameter('estado', \JGM\CoreBundle\Entity\EstadoEncargado::ONLINE)
                ->setParameter('fecha', $fecha)
                ->getQuery();
        try {
            return $consulta->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findByLikeNombre($nombre) {
        return $this->getEntityManager()
                        ->createQuery("SELECT e"
                                . " FROM UsuarioBundle:Usuario e"
                                . " WHERE lower(e.nombre) like lower(:nombre)")
                        ->setParameter('nombre', "%" . $nombre . "%")
                        ->getResult();
    }

}
