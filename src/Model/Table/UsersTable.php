<?php
declare(strict_types=1);

namespace UserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \UserManager\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \UserManager\Model\Entity\User newEmptyEntity()
 * @method \UserManager\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \UserManager\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \UserManager\Model\Entity\User get($primaryKey, $options = [])
 * @method \UserManager\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \UserManager\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \UserManager\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \UserManager\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'className' => 'UserManager.Roles',
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
            ->email('email')
            ->requirePresence('email', 'create', __('Email obligatorio'))
            ->notEmptyString('email', __('Email no puede estar vacio'));

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->allowEmptyString('name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255, __('Apellido máximo 255 carácteres'))
            ->allowEmptyString('last_name');

        $validator
            ->scalar('abrev')
            ->maxLength('abrev', 20, __('AAbreviatura máximo 20 carácteres'))
            ->allowEmptyString('abrev');

        $validator
            ->scalar('telefono')
            ->allowEmptyString('telefono');

        $validator
            ->scalar('text_color')
            ->maxLength('text_color', 255)
            ->allowEmptyString('text_color');

        $validator
            ->scalar('background_color')
            ->maxLength('background_color', 255)
            ->allowEmptyString('background_color');

        $validator
            ->integer('activo')
            ->requirePresence('activo', 'create')
            ->allowEmptyString('activo');

        $validator
            ->dateTime('last_login')
            ->allowEmptyDateTime('last_login');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->allowEmptyString('password');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }
    
}
