<?php

namespace App\Controller;

use App\Repository\CastingOfferRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/casting_offers', name: 'api_casting_offer_')]
class CastingOfferController extends AbstractController
{
    #[Route('/index', name: 'index', methods: ['GET'], priority: 2)]
    public function index(Request $request, CastingOfferRepository $repo): Response
    {
        // Get the data from the request
        $data = $request->query->all();

        $query = $repo->createQueryBuilder('c')
            ->select('c')
            ->join('c.emergencyLevel', 'el')
            ->where("c.startPublishDate >= DATE_SUB(CURRENT_DATE(), c.publicationDuration, 'day')")
            ->orderBy('c.sponsor', 'DESC')
            ->addOrderBy('el.level', 'ASC');

        // If job is in jobs
        if (isset($data['jobdomain']) && $data['jobdomain'] != 'null') {
            if (isset($data['job']) && $data['job'] != 'null') {
                $query->innerJoin('c.jobs', 'j')
                    ->andWhere('j.id = :job')
                    ->setParameter('job', $data['job']);
            } else {
                $query->innerJoin('c.jobs', 'j')
                    ->innerJoin('j.jobDomains', 'jd')
                    ->andWhere('jd.id = :jobDomain')
                    ->setParameter('jobDomain', $data['jobdomain']);
            }
        }

        // Contract type
        if (isset($data['contractType']) && $data['contractType'] != 'null') {
            $query->andWhere('c.contractType = :contract_type')
                ->setParameter('contract_type', $data['contractType']);
        }

        // Date order
        if (isset($data['date_order']) && $data['contractType'] != 'null') {
            $query->addOrderBy('c.startPublishDate', $data['date_order']);
        } else {
            $query->addOrderBy('c.startPublishDate', 'DESC');
        }

        $page = isset($data['page']) ? (int) $data['page'] : 1;
        $limit = isset($data['limit']) ? (int) $data['limit'] : 30;

        return $this->json($this->executeQueryWithPaginator($query, $page, $limit));
    }

    private function executeQueryWithPaginator(QueryBuilder $query, int $page, int $limit): array
    {
        $response = [
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => 0,
                'pages' => 0,
            ],
        ];

        $paginatedQuery = clone $query;

        $paginatedQuery
            ->select('count(c.id)')
        ;

        try {
            $response['pagination']['total'] = (int) $paginatedQuery->getQuery()->getSingleScalarResult();
        } catch (NoResultException | NonUniqueResultException) {
            $response['pagination']['total'] = 0;
        }
        $response['pagination']['pages'] = ceil($response['pagination']['total'] / $limit);

        $query->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        $response['data'] = $query->getQuery()->getResult();

        return $response;
    }
}
