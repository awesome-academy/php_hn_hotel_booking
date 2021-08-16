<?php

namespace Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ModelTestCase extends TestCase
{
    protected function assertHasManyRelation($relation, Model $model, $key = null, $parent = null)
    {
        $this->assertInstanceOf(HasMany::class, $relation);
        $key = $key ?? $model->getForeignKey();
        $this->assertEquals($key, $relation->getForeignKeyName());
        $parent = $parent ?? $model->getKeyName();
        $this->assertEquals($model->getTable() . '.' . $parent, $relation->getQualifiedParentKeyName());
    }

    protected function assertBelongsToRelation($relation, Model $related, $key = null, $owner = null)
    {
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $key = $key ?? $related->getForeignKey();
        $this->assertEquals($key, $relation->getForeignKeyName());
        $owner = $owner ?? $related->getKeyName();
        $this->assertEquals($owner, $relation->getOwnerKeyName());
    }

    protected function assertHasOneRelation($relation, Model $model, $key = null, $parent = null)
    {
        $this->assertInstanceOf(HasOne::class, $relation);
        $key = $key ?? $model->getForeignKey();
        $this->assertEquals($key, $relation->getForeignKeyName());
        $parent = $parent ?? $model->getKeyName();
        $this->assertEquals($model->getTable() . '.' . $parent, $relation->getQualifiedParentKeyName());
    }

    protected function assertBelongsToManyRelation($relation, Model $model, Model $related, $key = null, $owner = null)
    {
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $key = $key ?? $model->getForeignKey();
        $this->assertEquals($relation->getTable() . '.' . $key, $relation->getQualifiedForeignPivotKeyName());
        $owner = $owner ?? $related->getForeignKey();
        $this->assertEquals($relation->getTable() . '.' . $owner, $relation->getQualifiedRelatedPivotKeyName());
    }

    protected function assertMorphManyRelation($relation, $name)
    {
        $this->assertInstanceOf(MorphMany::class, $relation);
        $this->assertEquals($name . '_type', $relation->getMorphType());
        $this->assertEquals($name . '_id', $relation->getForeignKeyName());
    }
}
