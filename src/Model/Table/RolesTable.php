<?php
declare(strict_types=1);

namespace UserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Roles Model
 *
 * @property \UserManager\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \UserManager\Model\Entity\Role newEmptyEntity()
 * @method \UserManager\Model\Entity\Role newEntity(array $data, array $options = [])
 * @method \UserManager\Model\Entity\Role[] newEntities(array $data, array $options = [])
 * @method \UserManager\Model\Entity\Role get($primaryKey, $options = [])
 * @method \UserManager\Model\Entity\Role findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \UserManager\Model\Entity\Role patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \UserManager\Model\Entity\Role[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \UserManager\Model\Entity\Role|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\Role saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RolesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('roles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Users', [
            'foreignKey' => 'role_id',
            'className' => 'UserManager.Users',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('role')
            ->maxLength('role', 255, __('Longuitud máxima 255 caracteres'))
            ->requirePresence('role', 'create', __('El campo `role` es necesario'))
            ->notEmptyString('role', __('Rol no puede estar vacio'));

        return $validator;
    }
}
